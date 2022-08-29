<?php

namespace App\Http\Controllers;

use App\Exports\IncidentReportExport;
use App\Exports\PendingIncidentReportExport;
use App\Exports\RejectedIncidentReportExport;
use App\Http\Requests\CreateIncidentReportRequest;
use App\Http\Requests\CreateNewReportRequest;
use App\Models\IncidentReport;
use App\Models\InventoryRequest;
use App\Services\IncidentReport\IncidentReportService;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;

class incidentReportController extends Controller
{
    private $incidentReportService;
    private $inventory;
    private $fireAlarmLevels = [
        'First Alarm',
        'Second Alarm',
        'Third Alarm',
        'Fourth Alarm',
        'Fifth Alarm',
        'Task Force Alpha',
        'Task Force Bravo',
        'Task Force Charlie',
        'Task Force Delta',
        'Task Force Echo',
        'Task Force Hotel',
        'Task Force India',
        'General Alarm',
    ];

    public function __construct(IncidentReportService $incidentReportService, InventoryService $inventoryService) {
        $this->incidentReportService = $incidentReportService;
        $this->inventoryService = $inventoryService;
    }
     
    public function create()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.create', [
            'reports' => $this->incidentReportService->getIncidentReports($role),
            'fireAlarmLevels' => $this->fireAlarmLevels,
            'role' => $role,
            'action' => 'create',
        ]);
    }

    public function confirmData(IncidentReport $incident_report)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.show', [
            'report' => $incident_report,
            'role' => $role,
            'action' => 'ApproveOrReject',
        ]);
    }

    public function edit(IncidentReport $incident_report)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.edit', [
            'report' => $incident_report,
            'fireAlarmLevels' => $this->fireAlarmLevels,
            'role' => $role,
            'action' => 'edit',
        ]);
    }

    public function index()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.home', [
            'reports' => $this->incidentReportService->getAll(),
            'role' => $role,
            'topCOI' => $this->incidentReportService->topCOI(),
            'lowStreets' => $this->incidentReportService->lowStreets(),
        ]);
    }

    public function adminInventory()
    {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.adminInventory', [
            'products' => $this->inventoryService->getAllProducts(),
            'role' => $role,
        ]);
    }

    public function inventoryRequest()
    {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.inventoryRequest', [
            'requestProducts' => $this->inventoryService->getAllRequests(),
            'products' => $this->inventoryService->getAllProducts(),
            'role' => $role,
        ]);
    }

    public function report()
    {
        return view('employeeFolder.report', $this->incidentReportService->getReports());
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required | date',
            'fire_alarm_level' => 'required | string',
            'cause_of_incident' => 'required | string',
            'estimated_damage' => 'required | integer',
            'reported_by' => 'required | integer',
            'description' => 'required | string',
            'is_approved' => 'nullable | boolean',
            'is_rejected' => 'nullable | boolean',
            'baranggay' => 'required | string',
            'location' => 'required | string',
        ]);
        $this->incidentReportService->create($request);

        return redirect()->route('create');
    }

    public function show(IncidentReport $incident_report)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.show', [
            'report' => $incident_report,
            'role' => $role,
            'action' => 'show',
        ]);
    }

    public function update(Request $request, IncidentReport $incident_report)
    {
        $this->incidentReportService->update($request, $incident_report);

        return redirect()->route('create');
    }

    public function destroy(IncidentReport $incident_report)
    {
        $incident_report->delete();

        return redirect()->route('create');
    }

    public function approve(IncidentReport $incident_report)
    {
        $data = ['is_approved' => true];

        $incident_report->update($data);

        return redirect()->route('create');
    }

    public function reject(IncidentReport $incident_report)
    {
        $data = ['is_rejected' => true];

        $incident_report->update($data);

        return redirect()->route('create');
    }

    public function downloadApprovedReports()
    {
        return Excel::download(new IncidentReportExport, 'approvedReports.xlsx');
    }

    public function downloadPendingReports()
    {
        return Excel::download(new PendingIncidentReportExport, 'pendingReports.xlsx');
    }

    public function downloadRejectedReports()
    {
        return Excel::download(new RejectedIncidentReportExport, 'rejectedReports.xlsx');
    }

    public function downloadApprovedPdf()
    {
        $pdf = PDF::loadView('employeeFolder.pdfApprovedReport', [
            'reports' =>$this->incidentReportService->getApprovedTotal(),
            'current_date' => Carbon::now(),
        ]);
        
        return $pdf->download('ApprovedReports.pdf');
    }

    public function downloadPendingPdf()
    {
        $pdf = PDF::loadView('employeeFolder.pdfPendingReport', [
            'reports' =>$this->incidentReportService->getPendingTotal()
        ]);
        
        return $pdf->download('PendingReports.pdf');
    }

    public function downloadRejectedPdf()
    {
        $pdf = PDF::loadView('employeeFolder.pdfRejectedReport', [
            'reports' => $this->incidentReportService->getRejectedTotal()
        ]);
        
        return $pdf->download('RejectedReports.pdf');
    }

    public function downloadReportPdf(IncidentReport $incident_report)
    {
        $pdf = PDF::loadView('employeeFolder.pdfReport', [
            'report' => $incident_report,
        ]);

        return $pdf->download('Report.pdf');
    }

    public function createNewProductRequest(Request $request)
    {
        $this->inventoryService->createNewProductRequest($request);
        
        return redirect()->route('inventoryRequest');
    }

    public function removeRequest(InventoryRequest $product_request)
    {
        $product_request->delete();

        return redirect()->route('inventoryRequest');
    }

    public function inventory()
    {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.inventory', [
            'products' => $this->inventoryService->getAllProducts(),
            'role' => $role,
        ]);
    }

    public function adminInventoryRequest()
    {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.adminInventoryRequest', [
            'requestProducts' => $this->inventoryService->getAllRequests(),
            'role' => $role,
        ]);
    }

    public function approveRequest(InventoryRequest $product_request)
    {
        $data = ['is_approved' => 1];
        $product_request->update($data);

        return redirect()->route('adminInventoryRequest');
    }

    public function rejectRequest(InventoryRequest $product_request)
    {
        $data = ['is_rejected' => 1];
        $product_request->update($data);

        return redirect()->route('adminInventoryRequest');
    }
}