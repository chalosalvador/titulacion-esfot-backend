<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCorrectionStudentPdf extends Mailable
{
    use Queueable, SerializesModels;
    public $project;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $project->teacher;
        $project->status='project_corrections_done';
        $this->project = $project;
//        $project->students = $project->students->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.projects.comment.teacherpdf');
    }
}
