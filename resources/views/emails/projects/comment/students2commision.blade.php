@component('mail::message')
# Correcciones realizadas por el estudiante.
## El plan con el tema: {{$project->title}}.

## El estudiante/s {{$student->name}} registra las correcciones que fueron solicitadas por la comisión.

## Dirigete a la plataforma para verificar
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
