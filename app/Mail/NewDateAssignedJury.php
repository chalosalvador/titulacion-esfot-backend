<?php

namespace App\Mail;

use App\Models\Jury;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDateAssignedJury extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $student;
    public $teacher;
    public $dateAssigned;

    /**
     * Create a new message instance.
     *
     * @param Jury $jury
     */
    public function __construct(Jury $jury)
    {
        $project = Project::find($jury->project_id);
        $this->project = $project;
        $students_value = $project->students()->where('project_id',$jury->project_id)->first();
        $this->student = $students_value->user;
        $this->teacher = $project->teacher->user;
        $this->dateAssigned = $jury->tribunalSchedule;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Fecha de defensa asignada como parte del Jurado')
                    ->markdown('emails.projects.new.dateassignedjury');
    }
}
