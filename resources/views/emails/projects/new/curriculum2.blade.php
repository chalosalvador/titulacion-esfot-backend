@component('mail::message')
# Apto para la Asignación de jurado.

## Estimado/a {{$student->name}},
## Es un agrado informarte que cumples con los requisitos para continuar con el proceso de titulación.
### Puedes presentar su proyecto con el tema: {{$project->title}}

## Por favor espera la asignación de jurado.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
