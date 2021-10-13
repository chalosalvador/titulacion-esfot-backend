@component('mail::message')
# Apto para defensa oral.

## Estimado/a {{$student->name}},
<br>
## Es un agrado informarte que cumples con los requisitos para continuar con el proceso de titulación.
### Puedes defender tu proyecto registrado con el tema: {{$project->title}}
<br>
## Por favor espera la fecha de defensa.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
