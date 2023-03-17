<?php

namespace App\Http\Controllers;

use App\Exports\IncidentReportExport;
use App\Exports\PendingIncidentReportExport;
use App\Exports\RejectedIncidentReportExport;
use App\Http\Requests\CreateNewReportRequest;
use App\Models\IncidentReport;
use App\Models\Inventory;
use App\Models\InventoryRequest;
use App\Models\ItemList;
use App\Models\ListOfExecutives;
use App\Models\Maintenance;
use App\Services\IncidentReport\IncidentReportService;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class incidentReportController extends Controller
{
    private $incidentReportService;
    private $maintenance;
    private $listOfExecutives;
    private $inventoryService;
    private $itemList;
    private $inventory;
    private $fireAlarmLevels = [
        'False Alarm',
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
    private $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    public function __construct(IncidentReportService $incidentReportService, InventoryService $inventoryService, Inventory $inventory, ItemList $itemList, Maintenance $maintenance, ListOfExecutives $listOfExecutives) {
        $this->incidentReportService = $incidentReportService;
        $this->itemList = $itemList;
        $this->inventoryService = $inventoryService;
        $this->inventory = $inventory;
        $this->maintenance = $maintenance;
        $this->listOfExecutives = $listOfExecutives;
    }

    public function signIn() {
        return view('auth.sign-in');
    }
     
    public function create() {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.create', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'reports' => $this->incidentReportService->getIncidentReports($role),
            'fireAlarmLevels' => $this->fireAlarmLevels,
            'role' => $role,
            'action' => 'create',
            'months' => $this->months,
        ]);
    }

    public function search(Request $request) {
        if ($request->ajax()) {
            $role = Auth::user()->role->role_name;
            $output = "";
            $status = "";
            $actions = "";
            $reports = $this->incidentReportService->searchReports($request->search, $request->category);

            if ($reports != []) {
                foreach ($reports as $report) {
                    if ($role == 'Team Leader') {
                        if (Auth::user()->name != $report->reportedBy->name) {
                            if ($report->is_approved == 0 && $report->is_rejected == 0) {
                                $status = '<td class="text-center">Pending</td>';
                                $actions = '<td class="text-center"><a href=" route('. 'show'. ', '. $report->id. ')">
                                    <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-eye"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg></button></a></td>';
                                $output .= '<tr>'.
                                '<td class="text-center">'.$report->baranggay.'</td>'.
                                '<td class="text-center">'. $report->start_month. ' '.  $report->start_day. ','.
                                        $report->start_year.'</td>'.
                                '<td class="text-center">'. $report->fire_alarm_level.'</td>'.
                                '<td class="text-center">'. $report->cause_of_incident.'</td>'.
                                '<td class="text-center">'.'&#8369;'. number_format($report->estimated_damage).
                                '</td>'.
                                '<td class="text-center">'. $report->reportedBy->name.'</td>'.
                                $status.
                                $actions.
                                '</tr>';
                            }
                        }
                    }
                    elseif ($role == 'Employee') {
                        if (Auth::user()->name == $report->reportedBy->name) {
                            switch (true) {
                                case ($report->is_approved == 0 && $report->is_rejected == 0):
                                    $status = '<td class="text-center">Pending</td>';
                                break;
                                case ($report->is_approved == 1 && $report->is_rejected == 0):
                                    $status = '<td class="text-center">Approved</td>';
                                break;
                                case ($report->is_approved == 0 && $report->is_rejected == 1):
                                    $status = '<td class="text-center">Rejected</td>';
                                break;
                                default:
                                    $status = '<td class="text-center">Data Error</td>';
                                break;
                            };
                            switch (true) {
                                case ($report->is_approved == 1 && $report->is_rejected == 0):
                                    $actions = '<td class="text-center" colspan="3"><a href=" route('. 'show'. ', '. $report->id. ')">
                                    <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor"
                                    class="bi bi-eye" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg></button></a></td>';
                                break;
                                case ($report->is_approved == 0 || $report->is_rejected == 1):
                                    $actions = '<td class="text-center"><a href=" route('. 'show'. ', $report->id)"><button
                                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor"
                                                class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg></button></a>
                                    <td class="text-center"><a href=" route('. 'edit'. ', $report->id)"><button
                                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor"
                                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg></button></a>
                                    </td>
                                    <td class="text-center">
                                        <a href=" route('. 'remove'. ', $report->id)"><button
                                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor"
                                                class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg></button></a>
                                    </td>';
                                break;
                            }
                            $output .= '<tr>'.
                                '<td class="text-center">'.$report->baranggay.'</td>'.
                                '<td class="text-center">'. $report->start_month. ' '.  $report->start_day. ','.
                                     $report->start_year.'</td>'.
                                '<td class="text-center">'. $report->fire_alarm_level.'</td>'.
                                '<td class="text-center">'. $report->cause_of_incident.'</td>'.
                                '<td class="text-center">'.'&#8369;'. number_format($report->estimated_damage)
                                .'</td>'.
                                '<td class="text-center">'. $report->reportedBy->name.'</td>'.
                                $status.
                                $actions                        
                            .'</tr>';
                        }
                    }
                }
            }
        }
        return Response($output);
    }

    public function searchTeamLead(Request $request) {
        if ($request->ajax()) {
            $output = "";
            $status = "";
            $actions = "";
            $reports = $this->incidentReportService->searchReports($request->search, $request->category);

            if ($reports != []) {
                foreach ($reports as $report) {
                    if (Auth::user()->name == $report->reportedBy->name) {
                        switch (true) {
                            case ($report->is_approved == 0 && $report->is_rejected == 0):
                                $status = '<td class="text-center">Pending</td>';
                            break;
                            case ($report->is_approved == 1 && $report->is_rejected == 0):
                                $status = '<td class="text-center">Approved</td>';
                            break;
                            case ($report->is_approved == 0 && $report->is_rejected == 1):
                                $status = '<td class="text-center">Rejected</td>';
                            break;
                            default:
                                $status = '<td class="text-center">Data Error</td>';
                            break;
                        };
                        switch (true) {
                            case ($report->is_approved == 1 && $report->is_rejected == 0):
                                $actions = '<td class="text-center" colspan="3"><a href=" route('. 'show'. ', '. $report->id. ')">
                                <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor"
                                class="bi bi-eye" viewBox="0 0 16 16">
                                <path
                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                <path
                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg></button></a></td>';
                            break;
                            case ($report->is_approved == 0 || $report->is_rejected == 1):
                                $actions = '<td class="text-center"><a href=" route('. 'show'. ', $report->id)"><button
                                            class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor"
                                            class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg></button></a>
                                <td class="text-center"><a href=" route('. 'edit'. ', $report->id)"><button
                                            class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg></button></a>
                                </td>
                                <td class="text-center">
                                    <a href=" route('. 'remove'. ', $report->id)"><button
                                            class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg></button></a>
                                </td>';
                            break;
                        }
                        $output .= '<tr>'.
                            '<td class="text-center">'.$report->baranggay.'</td>'.
                            '<td class="text-center">'. $report->start_month. ' '.  $report->start_day. ','.
                                 $report->start_year.'</td>'.
                            '<td class="text-center">'. $report->fire_alarm_level.'</td>'.
                            '<td class="text-center">'. $report->cause_of_incident.'</td>'.
                            '<td class="text-center">'.'&#8369;'. number_format($report->estimated_damage)
                            .'</td>'.
                            '<td class="text-center">'. $report->reportedBy->name.'</td>'.
                            $status.
                            $actions                        
                        .'</tr>';
                    }
                }
            }
        }
        return Response($output);
    }

    public function searchDetailed(Request $request) {
        if ($request->ajax()) {
            $output = "";
            $status = "";
            $actions = "";
            $reports = $this->incidentReportService->searchReports($request->search, $request->category);

            if ($reports != []) {
                foreach ($reports as $report) {
                    if ($report->is_approved == 1 && $report->is_rejected == 0) {
                        $status = '<td class="text-center">Approved</td>';
                        $actions = '<td class="text-center"><a href=" route('. 'show'. ', '. $report->id. ')">
                            <button class="btn btn-primary">View</button></a></td>';
                        $output .= '<tr>'.
                        '<td class="text-center">'.$report->baranggay.'</td>'.
                        '<td class="text-center">'. $report->start_month. ' '.  $report->start_day. ','.
                                $report->start_year.'</td>'.
                        '<td class="text-center">'. $report->fire_alarm_level.'</td>'.
                        '<td class="text-center">'. $report->cause_of_incident.'</td>'.
                        '<td class="text-center">'.'&#8369;'. number_format($report->estimated_damage).
                        '</td>'.
                        '<td class="text-center">'. $report->reportedBy->name.'</td>'.
                        $status.
                        $actions.
                        '</tr>';
                    }
                }
            }
        }
        return Response($output);
    }

    public function createIncidentReport()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.createIncidentReport', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'fireAlarmLevels' => $this->fireAlarmLevels,
            'role' => $role,
            'action' => 'create',
            'months' => $this->months,
        ]);
    }

    public function teamLeadCreate()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.teamLeaderCreate', [
            'reports' => $this->incidentReportService->getIncidentReports($role),
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'fireAlarmLevels' => $this->fireAlarmLevels,
            'role' => $role,
            'action' => 'create',
            'months' => $this->months,
        ]);
    }

    public function confirmData(IncidentReport $incident_report)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.show', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'report' => $incident_report,
            'role' => $role,
            'action' => 'ApproveOrReject',
        ]);
    }

    public function edit(IncidentReport $incident_report)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.edit', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'report' => $incident_report,
            'fireAlarmLevels' => $this->fireAlarmLevels,
            'role' => $role,
            'months' => $this->months,
            'action' => 'edit',
        ]);
    }

    public function index()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.home', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'reportsEmployee' => $this->incidentReportService->getPendingEmployee(),
            'reportsTeamLeader' => $this->incidentReportService->getPending(),
            'reportsAdmin' => $this->incidentReportService->getIncidentReports($role),
            'role' => $role,
            'baranggays' => $this->incidentReportService->topBaranggay(),
            'months' => $this->incidentReportService->topMonth(),
        ]);
    }

    public function yearlyMonthlyReport() {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.yearlyMonthlyReport', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'role' => $role,
        ]);
    }

    public function adminInventory()
    {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.adminInventory', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'products' => $this->inventoryService->getAllProducts(),
            'role' => $role,
        ]);
    }

    public function inventoryRequest()
    {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.inventoryRequest', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'requestProducts' => $this->inventoryService->getAllRequestProducts(),
            'products' => $this->inventoryService->getAllProducts(),
            'role' => $role,
        ]);
    }

    public function report()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.report', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'all' => $this->incidentReportService->countAll(),
            'approved' => $this->incidentReportService->countApproved(),
            'pending' => $this->incidentReportService->countPending(),
            'rejected' => $this->incidentReportService->countRejected(),
            'topCOI' => $this->incidentReportService->topCOI(),
            'lowStreets' => $this->incidentReportService->lowStreets(),
            'reports' => $this->incidentReportService->getAll(),
            'role' => $role,
            
        ]);
    }

    public function detailedReport()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.detailedReport', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'reports' => $this->incidentReportService->getAll(),
            'role' => $role,
        ]);
    }

    public function back() {
        return redirect()->back();
    }

    public function store(CreateNewReportRequest $request)
    {
        $this->incidentReportService->create($request->validated());

        return redirect()->route('create')->with('success', 'Fire Incident Report is created!');
    }

    public function show(IncidentReport $incident_report)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.show', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'report' => $incident_report,
            'role' => $role,
            'action' => 'show',
        ]);
    }

    public function update(CreateNewReportRequest $request, IncidentReport $incident_report)
    {
        $this->incidentReportService->update($request->validated(), $incident_report);

        return redirect()->route('create');
    }

    public function destroy(IncidentReport $incident_report)
    {
        $incident_report->delete();

        return redirect()->route('create');
    }

    public function approve(IncidentReport $incident_report)
    {
        $this->incidentReportService->approve($incident_report);

        return redirect()->route('create');
    }

    public function reject(Request $request, IncidentReport $incident_report)
    {
        $request->validate([
            'input-rejection-notes' => 'required | string',
        ]);
        $this->incidentReportService->reject($request, $incident_report);

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

    public function downloadItems(Request $request, $acronym)
    {
        $request->validate([
            'input-status' => 'required | string',
        ]);

        $pdf = PDF::loadView('employeeFolder.pdfItemReport', [
            'items' => $this->inventoryService->getItems($request['input-status'], $acronym),
            'product' => $this->inventory->where(['item_acronym' => $acronym])->get(),
            'fireChief' => $this->listOfExecutives->where(['position' => 'EMS Fire Chief'])->get(),
            'coordinator' => $this->listOfExecutives->where(['position' => 'Barangay Coordinator'])->get(),
            'treasurer' => $this->listOfExecutives->where(['position' => 'Barangay Treasurer'])->get(),
        ]);

        return $pdf->download('ItemReport.pdf');
    }

    public function downloadMonthly(Request $request)
    {
        $request->validate([
            'input-month-monthly' => 'required | string',
            'input-year-monthly' => 'required | integer',
        ]);

        $pdf = PDF::loadView('employeeFolder.pdfMonthlyApprovedReport', [
            'reports' => $this->incidentReportService->getMonth($request['input-month-monthly'], $request['input-year-monthly']),
            'month' => $request['input-month-monthly'],
            'year' => $request['input-year-monthly'],
            'fireChief' => $this->listOfExecutives->where(['position' => 'EMS Fire Chief'])->get(),
            'coordinator' => $this->listOfExecutives->where(['position' => 'Barangay Coordinator'])->get(),
            'secretary' => $this->listOfExecutives->where(['position' => 'Barangay Secretary'])->get(),
        ]);

        return $pdf->download('MonthlyReport.pdf');
    }

    public function downloadYearly(Request $request)
    {
        $request->validate([
            'input-year-yearly' => 'required | integer',
        ]);

        $pdf = PDF::loadView('employeeFolder.pdfYearlyApprovedReport', [
            'reports' => $this->incidentReportService->getYear($request['input-year-yearly']),
            'year' => $request['input-year-yearly'],
            'fireChief' => $this->listOfExecutives->where(['position' => 'EMS Fire Chief'])->get(),
            'coordinator' => $this->listOfExecutives->where(['position' => 'Barangay Coordinator'])->get(),
            'secretary' => $this->listOfExecutives->where(['position' => 'Barangay Secretary'])->get(),
        ]);

        return $pdf->download('YearlyReport.pdf');
    }

    public function downloadApprovedPdf()
    {
        $pdf = PDF::loadView('employeeFolder.pdfApprovedReport', [
            'reports' =>$this->incidentReportService->getApprovedTotal(),
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
        // dd('Downloading');
        $pdf = PDF::loadView('employeeFolder.pdfReport', [
            'report' => $incident_report,
            'fireChief' => $this->listOfExecutives->where(['position' => 'EMS Fire Chief'])->get(),
            'coordinator' => $this->listOfExecutives->where(['position' => 'Barangay Coordinator'])->get(),
        ]);

        return $pdf->download('Report.pdf');
    }

    public function createNewProductRequest(Request $request)
    {
        $this->inventoryService->createNewProductRequest($request);
        
        return redirect()->route('inventoryRequest')->with('success', 'Item Request has been created!');
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
            'logo' => $this->maintenance->where(['id' => 1])->get(),    
            'products' => $this->inventoryService->getAllProducts(),
            'role' => $role,
        ]);
    }

    public function adminInventoryRequest()
    {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.adminInventoryRequest', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'requestProducts' => $this->inventoryService->getAllRequestProducts(),
            'role' => $role,
        ]);
    }

    public function approveRequest(InventoryRequest $product_request)
    {
        $data = ['is_approved' => 1];
        $product = $this->inventory->where(['product_name' => $product_request->product_name, 'deleted_at' => null])->first();
        // dd($product);
        if ($product === null) {
            $this->inventoryService->createNewProudctByRequest($product_request);
        }
        else {
            $this->inventoryService->addStockByRequest($product_request);
        }
        
        $product_request->update($data);

        return redirect()->route('adminInventoryRequest')->with('success', 'Item Request has been Approved!');
    }

    public function rejectRequest(InventoryRequest $product_request)
    {
        $data = ['is_rejected' => 1];
        $product_request->update($data);

        return redirect()->route('adminInventoryRequest')->with('success', 'Item Request has been Rejected!');
    }

    public function viewItemList(Inventory $product) {
        $role = Auth::user()->role->role_name;

        return view('employeeFolder.viewItemList', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'role' => $role,
            'product' => $product,
            'productAcronym' => $product->item_acronym,
            'itemList' => $this->inventoryService->getAllItemList(),
        ]);
    }

    public function underMaintenance(ItemList $item)
    {
        $acronym = explode('-', $item->item_number);
        $data = [
            'status' => 'under maintenance',
        ];
        $item->update($data);
        $workingItem = $this->itemList->where(['acronym' => $acronym, 'status' => 'working'])->count();
        $undermaintenace = $this->itemList->where(['acronym' => $acronym, 'status' => 'under maintenance'])->count();
        $disposed = $this->itemList->where(['acronym' => $acronym, 'status' => 'condemn'])->count();
        $notWorkingItem = $undermaintenace + $disposed;
        // dd($notWorkingItem);
        DB::update('update inventories set working_stock = ?, not_working_stock = ? where item_acronym = ?', [$workingItem, $notWorkingItem, $acronym[0]]);

        return redirect()->route('adminInventory');
    }
    
    public function condemn(ItemList $item)
    {
        $acronym = explode('-', $item->item_number);
        $data = [
            'status' => 'condemn',
        ];
        $item->update($data);
        $workingItem = $this->itemList->where(['acronym' => $acronym, 'status' => 'working'])->count();
        $undermaintenace = $this->itemList->where(['acronym' => $acronym, 'status' => 'under maintenance'])->count();
        $disposed = $this->itemList->where(['acronym' => $acronym, 'status' => 'condemn'])->count();
        $notWorkingItem = $undermaintenace + $disposed;
        // dd($notWorkingItem);
        DB::update('update inventories set working_stock = ?, not_working_stock = ? where item_acronym = ?', [$workingItem, $notWorkingItem, $acronym[0]]);

        return redirect()->route('adminInventory');
    }

    public function repaired(ItemList $item)
    {
        $acronym = explode('-', $item->item_number);
        $data = [
            'status' => 'working',
        ];
        $item->update($data);
        $workingItem = $this->itemList->where(['acronym' => $acronym, 'status' => 'working'])->count();
        $undermaintenace = $this->itemList->where(['acronym' => $acronym, 'status' => 'under maintenance'])->count();
        $disposed = $this->itemList->where(['acronym' => $acronym, 'status' => 'condemn'])->count();
        $notWorkingItem = $undermaintenace + $disposed;
        // dd($notWorkingItem);
        DB::update('update inventories set working_stock = ?, not_working_stock = ? where item_acronym = ?', [$workingItem, $notWorkingItem, $acronym[0]]);

        return redirect()->route('adminInventory');
    }
}