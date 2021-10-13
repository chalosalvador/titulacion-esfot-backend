@component('mail::message')
# Observaciones del director.
## Estimado/a {{$student->name}},

## El informe del proyecto de titulación con el tema:
{{$project->title}}

## Tu director {{$teacher->name}} ha realizado observaciones en el informe.

## Dirigete a la plataforma para hacer las correciones del informe.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
