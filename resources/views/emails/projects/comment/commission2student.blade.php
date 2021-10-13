@component('mail::message')
# Observaciones de la comisión.
## Estimado/a {{$student->name}}.

## Tu plan con el tema: {{$project->title}}.
Ha recibido observaciones por parte de la comisión

## Dirigete a la plataforma para hacer las correciones.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
