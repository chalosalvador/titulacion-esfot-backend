<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectCompleted extends Mailable
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
        $students_value = $project->students()->where('project_id',$project->id)->first();
        $this->student = $students_value->user;
        $this->project = $project;
    }

    /**
     * Build the message completado.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Proceso de titulación completado')
                    ->markdown('emails.projects.new.projectcompleted');
    }
}
