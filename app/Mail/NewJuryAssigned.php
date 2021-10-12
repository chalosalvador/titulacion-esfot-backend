<?php

namespace App\Mail;

use App\Models\Jury;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewJuryAssigned extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $student;
    public $teacher;

    /**
     * Create a new message instance.
     *
     * @param Jury $jury
     */
    public function __construct(Jury $jury)
    {
//        $project->teacher ;
//        $this->project = $project;
        $project = Project::find($jury->project_id);
        $this->project = $project;
        $students_value = $project->students()->where('project_id',$jury->project_id)->first();
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
        return $this->markdown('emails.projects.new.juryassigned');
    }
}
