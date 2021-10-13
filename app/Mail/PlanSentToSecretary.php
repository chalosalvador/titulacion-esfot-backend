<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class PlanSentToSecretary extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->pdf=PDF::LoadView("emails.projects.reports.planpdf", $this->project);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.projects.reports.secretary')->attachData($this->pdf->output(),"plan-pdf.pdf");
    }
}
