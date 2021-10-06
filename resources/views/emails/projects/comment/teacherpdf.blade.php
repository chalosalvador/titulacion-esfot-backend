@component('mail::message')
# Correcciones realizadas por el estudiante.

El proyecto de titulación del estudiante {{$student->name}}
con el tema: {{$project->title}}.

## Registra las correcciones de las observaciones realizadas en la plataforma.

Dirigete a la plataforma para revisar los cambios.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
