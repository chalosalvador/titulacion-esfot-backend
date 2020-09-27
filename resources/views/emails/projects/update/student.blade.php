@component('mail::project')
    #Plan aprobado.
    ##Tu plan {{$project->title}}.
    ##ha sido aprobado por tu director {{$project->teacher->name}}.
    ##Dirigete a la plataforma para conocer el siguiente paso.


@endcomponent
