@component('mail::project')
    #Nuevo plan subido.
    ##Por favor dirigete al sistema para revisar el plan.
    {{$project->title}}
    ##De los estudiantes
    {{$project->student->name}}


@endcomponent
