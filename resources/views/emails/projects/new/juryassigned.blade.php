@component('mail::message')
# Ha sido asignado como jurado.

## Estimado/a,
### Ha sido asignado como parte del jurado para la calificación del
proyecto con el tema: {{$project->title}}

### Por parte de el/los estudiante/s {{$student->name}}


## Por favor dirigete al sistema para revisarlo.

@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
