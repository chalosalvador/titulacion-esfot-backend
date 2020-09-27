@component('mail::message')
# Plan aprobado.
## Tu plan {{$project->title}}.
## Ha sido aprobado por tu director {{$project->teacher->name}}.
## Dirigete a la plataforma para conocer el siguiente paso.


@endcomponent
