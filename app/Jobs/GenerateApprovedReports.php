<?php

declare(strict_types = 1);

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateApprovedReports implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;
    private $pdf;

    public function __construct(Pdf $pdf)
    {
        $this->pdf = $pdf;
    }

    public function handle(array $data)
    {
        $this->pdf->loadView('employeeFolder.pdfTableReport', [
            'reports' => $data
        ]);
    }
}
