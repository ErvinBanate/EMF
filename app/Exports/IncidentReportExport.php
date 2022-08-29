<?php

namespace App\Exports;

use App\Models\IncidentReport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class IncidentReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return[
            'ID',
            'Date',
            'Fire Alarm Level',
            'Cause of Incident',
            'Estimated Damage',
            'Reported By',
            'Street',
            'Block Number',
            'House Type',
        ];
    }

    public function collection()
    {
        return IncidentReport::select('id',
                'date',
                'fire_alarm_level',
                'cause_of_incident',
                'estimated_damage',
                'reported_by',
                'street',
                'block_no',
                'house_type',)->where(['is_approved' => 1, 'is_rejected' => 0])->get();
    }
}
