@component('mail::message')
# Correcciones realizadas por el estudiante.

## El plan con el tema: {{$project->title}}.
## El estudiante/s {{$student->name}} registra las correcciones en las observaciones que registraste.


## Dirigete a la plataforma para verificar los cambios.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
