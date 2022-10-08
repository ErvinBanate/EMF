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
        $this->incidentReport->create($this->parseData($request));
    }

    public function update(Request $request, IncidentReport $incident_report): void
    {
        $incident_report->update($this->parseData($request));
    }

    public function getAll() 
    {
        return $this->incidentReport->all()->sortByDesc('created_at');
    }

    public function getApproved()
    {
        return $this->incidentReport->where(['is_approved' => 1, 'is_rejected' => 0])
                ->get();
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
        // dd($request);
        return [
            'date' => $request['input-date'],
            'fire_alarm_level' => $request['input-fire-alarm-level'],
            'cause_of_incident' => $request['input-cause-of-incident'],
            'estimated_damage' => $request['input-estimated-damage'],
            'reported_by' => $request['input-reported-by'],
            'description' => $request['input-description'],
            'baranggay' => $request['input-baranggay'],
            'location' => $request['input-location'],
        ];
    }
}