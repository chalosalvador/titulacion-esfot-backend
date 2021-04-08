<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class NewProjectUploadTeacher extends Mailable
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
        $project->teacher = $project->teacher->user;
        $this->project = $project;
        $this->pdf=PDF::LoadView("emails.projects.reports.planpdf");

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.projects.new.teacher')->attachData($this->pdf->output(),"plan-pdf.pdf");
    }
}
