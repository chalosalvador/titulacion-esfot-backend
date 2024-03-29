<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectRejected extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $student;
    public $teacher;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
//        $project->status='plan_approved_director';
        $this->project = $project;
        $students_value = $project->students()->where('project_id',$project->id)->first();
        $this->student = $students_value->user;
        $this->teacher = $project->teacher->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Proyecto rechazado')
                    ->markdown('emails.projects.new.projectrejected');
    }
}
