<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\Jury;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TribunalAssignedTeacher extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $student;
    public $teacher;
    public $teachers;
    public $jury;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $project->teacher ;
        $this->project = $project;
        $students_value = $project->students()->where('project_id',$project->id)->first();
        $this->student = $students_value->user;
        $this->teacher = $project->teacher->user;
        $this->jury = $project->jury()->where('project_id',$project->id)->first();
        $this->teachers = $this->jury->teachers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tribunal asignado')
                    ->markdown('emails.projects.new.tribunalassignedteacher');
    }
}
