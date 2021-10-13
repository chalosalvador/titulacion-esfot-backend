@component('mail::message')
# Fecha de defensa Asignada

## Estimado/a {{$student->name}},
## Ya se ha asignado a fecha de defensa para el proyecto con el tema: {{$project->title}}

### La fecha designada es : {{$jury->tribunalSchedule}}

## Dirigete a la plataforma para ver la fecha.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
