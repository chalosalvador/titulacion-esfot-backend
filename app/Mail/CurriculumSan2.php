<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurriculumSan2 extends Mailable
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
//        $project->status='plan_approved_director';
        $this->project = $project;
        $students_value = $project->students()->where('project_id',$project->id)->first();
        $this->student = $students_value->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Curriculum Saneado')
                    ->markdown('emails.projects.new.curriculum2');
    }
}
