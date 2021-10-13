@component('mail::message')
# Tribunal Asignado

## Estimado/a {{$student->name}},
## Es una agrado informarte que se ha asignado un tribunal para el proyecto con el tema: {{$project->title}}

### Los miembros del tribunal son:



Por favor espera la fecha de defensa.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
