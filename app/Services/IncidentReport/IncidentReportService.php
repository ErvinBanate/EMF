<?php

declare(strict_types = 1);

namespace App\Services\IncidentReport;

use App\Models\IncidentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncidentReportService 
{
    private $incidentReport;

    public function __construct(IncidentReport $incidentReport)
    {
        $this->incidentReport = $incidentReport;
    }

    public function create($request): void
    {
        $data = $this->parseData($request);
        $imagePath = $request['input-image']->store('evidences', 'public');
        $data += [
            'image' => $imagePath,
        ];

        $this->incidentReport->create($data);
    }

    public function update($request, IncidentReport $incident_report): void
    {

        if (isset($request['input-image'])) {
            // dd($request['input-image']);
            $data = $this->parseData($request);
            $imagePath = $request['input-image']->store('evidences', 'public');
            $data += [
                'image' => $imagePath,
            ];
            $incident_report->update($data);
        }
        else {
            $incident_report->update($this->parseData($request));
        }
    }

    public function approve(IncidentReport $incident_report) 
    {
        $data = ['is_approved' => true];
        // dd('approving');

        $incident_report->update($data);
    }

    public function reject($request, IncidentReport $incident_report) 
    {
        date_default_timezone_set("Asia/Manila");
        $timestamp = date("F d, Y h:i:sa");
        if ($incident_report->rejection_notes == null) {
            $data = [
                'rejection_notes' => $incident_report->rejection_notes . "\n \n" . $request['input-rejection-notes'] . " (" . $timestamp . ")",
                'is_rejected' => true,
            ];
        }
        else {
            $data = [
                'rejection_notes' => $request['input-rejection-notes'] . " " . $timestamp,
                'is_rejected' => true,
            ];
        }

        $incident_report->update($data);
    }

    public function searchReports($search, $category) {
        $resultReport = array();
        $searchStr = '%'.$search.'%';

        $resultReport = $this->incidentReport->where($category,'LIKE',$searchStr)->get();

        return $resultReport;
    }

    public function getAll() 
    {
        return $this->incidentReport->all()->sortByDesc('created_at');
    }

    public function getMonthReports($month, $year)
    {
        return $this->incidentReport->where(['start_month' => $month, 'start_year' => $year, 'is_approved' => 1, 'is_rejected' => 0])
                ->get()->sortBy('start_day');
    }

    public function getMonth($month, $year)
    {
        $reports = $this->getMonthReports($month, $year);

        return [
            'data' => $reports,
            'total' => $reports->sum('estimated_damage'),
        ];
    }

    public function getYearReports($year)
    {
        return $this->incidentReport->where(['start_year' => $year, 'is_approved' => 1, 'is_rejected' => 0])
                ->get()->sortBy('start_day');
    }

    public function getYear($year)
    {
        $reports = $this->getYearReports($year);

        return [
            'data' => $reports,
            'total' => $reports->sum('estimated_damage'),
        ];
    }

    public function getApproved()
    {
        return $this->incidentReport->where(['is_approved' => 1, 'is_rejected' => 0])
                ->get()->sortByDesc('created_at');
    }

    public function getPending()
    {
        return $this->incidentReport->where(['is_approved' => 0, 'is_rejected' => 0])
                ->get();
    }

    public function getRejected()
    {
        return $this->incidentReport->where(['is_approved' => 0, 'is_rejected' => 1])
                ->get();
    }

    public function getNew5()
    {
        return $this->incidentReport->all()->sortByDesc('created_at')->take(5);
    }

    public function getIncidentReports(string $role)
    {
        if ($role === IncidentReport::EMPLOYEE)
        {
            return $this->incidentReport->with('reportedBy')
                    ->where('reported_by', Auth::user()->id)->get()->sortByDesc('created_at');
        }
        if ($role === IncidentReport::TEAMLEADER)
        {
            return $this->incidentReport->with('reportedBy')->get()->sortByDesc('created_at');
        }
        if ($role === IncidentReport::ADMIN)
        {
            return $this->incidentReport->with('reportedBy')
                    ->where(['is_approved' => 1, 'is_rejected' => 0])->get()->sortByDesc('created_at');
        }
    }

    public function getPendingEmployee() {
        return $this->incidentReport->with('reportedBy')
                    ->where(['reported_by' => Auth::user()->id, 'is_approved' => 0, 'is_rejected' => 0])->get()->sortByDesc('created_at');
    }
    
    public function countAll()
    {
        return $this->incidentReport->count();
    }

    public function countApproved()
    {
        return $this->incidentReport->where(['is_approved' => 1, 'is_rejected' => 0])
                ->count();
    }

    public function countPending()
    {
        return $this->incidentReport->where(['is_approved' => 0, 'is_rejected' => 0])
                ->count();
    }

    public function countRejected()
    {
        return $this->incidentReport->where(['is_approved' => 0, 'is_rejected' => 1])
                ->count();
    }

    public function topCOI()
    {
        return $this->incidentReport->select('cause_of_incident', DB::raw('count(*) as total'))
                ->groupBy('cause_of_incident')->orderBy('total', 'DESC')->take(3)->get();
    }

    public function topBaranggay()
    {
        return $this->incidentReport->select('baranggay', DB::raw('count(*) as total'))
                ->groupBy('baranggay')->orderBy('total', 'DESC')->take(3)->get();
    }

    public function topMonth()
    {
        return $this->incidentReport->select('start_month', DB::raw('count(*) as total'))
                ->groupBy('start_month')->orderBy('total', 'DESC')->take(5)->get();
    }

    public function lowStreets()
    {
        return $this->incidentReport->all()->sortBy('created_at')->take(3);
    }

    public function getApprovedTotal()
    {
        $approved_reports = $this->getApproved();

        return [
            'data' => $approved_reports,
            'total' => $approved_reports->sum('estimated_damage'),
        ];
    }

    public function getPendingTotal()
    {
        $pending_reports = $this->getPending();

        return [
            'data' => $pending_reports,
            'total' => $pending_reports->sum('estimated_damage'),
        ];
    }

    public function getRejectedTotal()
    {
        $rejected_reports = $this->getRejected();

        return [
            'data' => $rejected_reports,
            'total' => $rejected_reports->sum('estimated_damage'),
        ];
    }

    public function getReports()
    {
        return [
            'all' => $this->countAll(),
            'approved' => $this->countApproved(),
            'pending' => $this->countPending(),
            'rejected' => $this->countRejected(),
            'topCOI' => $this->topCOI(),
            'lowStreets' => $this->lowStreets(),
            'reports' => $this->getAll(),
            'role' => auth()->user()->role->role_name,
        ];
    }

    public function parseData($request): array
    {
        // $imgBase64 = base64_encode($request['input-evidence']->extension());
        // dd(base64_decode($imgBase64));
        return [
            'start_month' => $request['input-start-month'],
            'start_day' => $request['input-start-day'],
            'start_year' => $request['input-start-year'],
            'time_started' => $request['input-start-time'],
            'end_month' => $request['input-end-month'],
            'end_day' => $request['input-end-day'],
            'end_year' => $request['input-end-year'],
            'time_ended' => $request['input-end-time'],
            'fire_alarm_level' => $request['input-fire-alarm-level'],
            'cause_of_incident' => $request['input-cause-of-incident'],
            'estimated_damage' => $request['input-estimated-damage'],
            'reported_by' => $request['input-reported-by'],
            'families_affected' => $request['input-families-affected'],
            'description' => $request['input-description'],
            'baranggay' => $request['input-baranggay'],
            'location' => $request['input-location'],
            'is_rejected' => 0,
        ];
    }
}