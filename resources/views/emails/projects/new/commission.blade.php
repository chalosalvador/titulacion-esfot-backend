@component('mail::message')
# Nuevo plan de titulación subido.

## Estimado {{$teacher->name}}, como parte de la comisión, se ha registrado un nuevo plan.
### El título del tema del plan es: {{$project->title}}
### Por parte de el/los estudiante/s {{$student->name}}


## Por favor dirigete al sistema para revisar el plan.

@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
