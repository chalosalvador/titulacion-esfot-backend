@component('mail::message')
# Observaciones del director.
## Tu plan: {{$project->title}}.
## Has recibido observaciones de tu director {{$project->teacher->name}}.
## Dirigete a la plataforma para hacer las correciones.


@endcomponent
