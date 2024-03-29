<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCorrectionDone2 extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $student;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
//        $project->status='plan_corrections_done_2';
        $this->project = $project;
        $students_value = $project->students()->where('project_id',$project->id)->first();
        $this->student = $students_value->user;
//        $project->students = $project->students->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Correcciones realizadas por el estudiante')
                    ->markdown('emails.projects.comment.students2commision');
    }
}
