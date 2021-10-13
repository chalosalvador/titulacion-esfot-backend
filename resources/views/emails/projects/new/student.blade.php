@component('mail::message')
# Plan subido.

## Estimado/a {{$student->name}},
<br>
## Tu plan ha sido correctamente enviado.
<br>
### El título registrado de tu plan es: {{$project->title}}
## Por favor espera las observaciones de tu director.

@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
