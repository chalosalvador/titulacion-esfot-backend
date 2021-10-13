<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDateAssigned extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $student;
    public $jury;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $students_value = $project->students()->where('project_id',$project->id)->first();
        $this->student = $students_value->user;
        $this->jury = $project->jury()->where('project_id',$project->id)->first();
//        $this->date=$jury_value->tribunalSchedule;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Fecha de defensa asignada')
                    ->markdown('emails.projects.new.dateassigned');
    }
}
