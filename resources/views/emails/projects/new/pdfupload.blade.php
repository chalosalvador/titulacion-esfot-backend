@component('mail::message')
# Nuevo PDF subido.

## Estimado {{$teacher->name}},

### Se ha registrado un nuevo Informe con el título del tema: {{$project->title}}
### Por parte de el/los estudiante/s {{$student->name}}


Por favor dirigete al sistema para revisar el informe.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
