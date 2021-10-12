<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDateAssignedTeacher extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $student;
    public $jury;
    public $teacher;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {

//        $project->status='date_defense_assigned';
        $this->project = $project;
        $this->teacher = $project->teacher->user;
//        $students_value = $project->students()->where('project_id',$project->id)->first();
//        $this->student = $students_value->user;
        $this->jury = $project->jury()->where('project_id',$project->id)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.projects.new.dateassignedteacher');
    }
}
