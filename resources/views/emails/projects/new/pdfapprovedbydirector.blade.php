@component('mail::message')
# Informe aprobado.

## Estimado/a {{$student->name}},
<br>
El informe del proyecto de titulación con el tema: {{$project->title}}.

## Tu director {{$teacher->name}} ha aprobado el envío del pdf al tribunal.
<br>
Dirigete a la plataforma para enviarlo.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
