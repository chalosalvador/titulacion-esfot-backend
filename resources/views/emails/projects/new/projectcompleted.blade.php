@component('mail::message')
# Proyecto Completado.

## Estimado/a {{$student->name}},

## ¡Felicidades! Haz completado el proceso de titulación.

### El título registrado de tu proyecto es: {{$project->title}}


@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
