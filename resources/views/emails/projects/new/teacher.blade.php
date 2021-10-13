@component('mail::message')
# Nuevo plan subido.

## Estimado/a {{$teacher->name}},
<br>
## Los estudiante/s {{$student->name}} han subido un nuevo plan en el que constas como director,
### Título del plan: {{$project->title}}

<br>
Por favor dirigete al sistema para revisar el plan.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}


@endcomponent
