@component('mail::message')
# Fecha de defensa Asignada

## Estimado/a miembro del jurado,
## Ya se ha asignado a fecha de defensa para el proyecto con el tema: {{$project->title}}

### La fecha designada es : {{$dateAssigned}}

## Dirigete a la plataforma para ver la fecha.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
