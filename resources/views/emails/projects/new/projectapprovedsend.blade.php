@component('mail::message')
# Proyecto aprobado para envíar.

## Estimado/a {{$student->name}},

## Es un agrado informarte que el jurado aprobó tu plan para continuar con el proceso de titulación
de tu proyecto registrado con el tema: {{$project->title}}

## Por favor espera la autorización para una fecha de defensa.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
