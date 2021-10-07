@component('mail::message')
# Observaciones del director.
## Estimado/a {{$student->name}}.
## Tu plan con el tema: {{$project->title}}.


## {{$teacher->name}} ha realizado observaciones en tu plan.



Dirigete a la plataforma para hacer las correciones.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
