<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plan PDF</title>
{{--    <link rel="stylesheet" href="{{asset("css/styles.css")}}" type="text/css" media="all" />--}}
    <style type="text/css">
        * {
            font-family: "Times New Roman", Times, serif;
        }

        header {
            margin-top: 50px;
            display: flex;
            flex-direction: row;
            margin-left: 400px;
        }

        header p {
            text-align: center;
        }

        .buho {
            margin-left: 190px;
        }

        .title-header-section {
            align-self: center;
            margin-left: 190px;
        }

        .faa {
            text-align: right;
            margin-right: 440px;
        }

        .title-header {
            margin: 0;
        }

        .title-institute {
            text-align: center;
        }

        .title-institute h2 {
            margin: 0;
        }

        .project-type{
            text-align: center;
            margin-top: 60px;
        }

        .plan-content{
            width: 800px;
            margin-left: 450px;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            width: 100%;
        }

        td {
            width: 50%;
        }

        .title-section {
            text-align: left;
            font-size: 20px;
        }

        .students-section {
            padding: 0px 5px 50px;
        }

        .project-area-section {
            padding: 5px 10px 20px 5px;
        }

        .date-section {
            padding: 0 5px 30px;
        }

        .text-description {
            margin-left: 15px;
            margin-right: 10px;
            text-align: justify;
            font-size: large;
        }
    </style>
</head>
<body>

<header>
    <img src="{{asset("images/logo-poli.png")}}" alt="Escuela Politécnica Nacional">
    <div class="title-header-section">
        <p class="title-header"><strong>ESCUELA POLITÉCNICA NACIONAL</strong></p>
        <p class="title-header"><strong>VICERRECTORADO DE DOCENCIA</strong></p>
    </div>
    <img src="{{asset("images/logo-buho.jpg")}}" alt="Buho" class="buho">
</header>
<h6 class="faa"><strong>F_AA_225</strong></h6>

<div class="title-institute">
    <h2><strong>ESCUELA DE FORMACIÓN DE TECNÓGOLOS</strong></h2>
    <h2><strong>CARRERA DE ANÁLISIS DE SISTEMAS INFORMATICOS</strong></h2>
</div>

<div class="project-type">
    <h3>PLAN DE TRABAJO DE TITULACIÓN</h3>
    <h3>TIPO DE TRABAJO DE TITULACIÓN: PROYECTO INTEGRADOR</h3>
</div>

<div class="plan-content">
    <table>
        <tr>
            <th colspan="2" class="title-section">I. INFORMACIÓN BÁSICA</th>
        </tr>
        <tr>
            <td class="students-section">
                <strong>PROPUESTO POR:</strong>
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kevin Segovia
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nicole Zambrano
            </td>
            <td class="project-area-section">
                <strong>LINEA DE INVESTIGACIÓN:</strong>
                <br><br>
                Creación y gestión de software
                <br><br>
                <strong>ÁREA DE CONOCIMIENTO:</strong>
                <br><br>
                Ingeniería de software
            </td>
        </tr>
        <tr>
            <td>
                <strong>AUSPICIADO POR:</strong>
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>DIRECTOR: </strong>Ing. Edwin Salvador
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>COODIRECTOR: </strong>Ing. Mónica Vinueza
            </td>
            <td class="date-section">
                <strong>FECHA:</strong>
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;17/06/2021
            </td>
        </tr>
        <tr>
            <th colspan="2" class="title-section">II. INFORMACIÓN DEL TRABAJO DE TITULACIÓN</th>
        </tr>
        <tr>
            <td colspan="2">
                <strong>1.  Título de trabajo de titulación</strong>
                <br>
                <p class="text-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pulvinar, sem lacinia accumsan fringilla, risus libero pharetra ligula, non molestie ex enim eget elit. Integer dapibus augue ut quam vestibulum semper. Pellentesque ultrices ultricies ultrices</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>2.  Planteamiento del problema</strong>
                <p class="text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. Donec nunc risus, consectetur vel luctus a, vestibulum elementum massa. Etiam faucibus tellus erat, non condimentum magna euismod a. Nullam elit eros, placerat sit amet suscipit a, lobortis et orci. Suspendisse eu odio eros. Duis at felis eget massa elementum dapibus. Curabitur aliquam ac metus eget malesuada. Sed mollis condimentum eros ut placerat. In sagittis lobortis metus a pulvinar. Fusce dolor augue, dapibus blandit suscipit ac, mollis id diam. Fusce felis enim, molestie in lacinia a, tristique at risus. Integer ac ante ut lorem egestas tristique.Praesent quis diam sed quam porttitor laoreet non condimentum sem. Integer consequat mauris turpis, cursus feugiat eros scelerisque imperdiet. Aliquam vulputate orci sed erat bibendum placerat non nec lectus. Nunc eget dui nec magna pretium suscipit. Etiam nec odio aliquam, commodo tellus nec, dictum enim. Suspendisse ut sem vulputate justo dictum consequat. Vivamus non magna ut nulla auctor scelerisque ut sit amet diam. Fusce sagittis diam est, in pulvinar purus malesuada ac.Vivamus eu ipsum vel tortor iaculis lobortis. Nulla quis eros vel urna porttitor scelerisque ut et odio. Phasellus eu maximus ipsum. Aenean hendrerit lacus ornare finibus suscipit. Nulla condimentum ipsum in sem laoreet, ut consequat quam efficitur. Nunc libero nulla, dapibus eget ultrices eget, sodales quis urna. Morbi et neque nec nisl vulputate maximus iaculis sit amet urna. In sed diam lorem. Etiam ac tempus magna. In in dignissim elit. Nulla gravida lacinia libero, in tincidunt nibh tempus vitae.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>3.  Justificación</strong>
                <p class="text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. Donec nunc risus, consectetur vel luctus a, vestibulum elementum massa. Etiam faucibus tellus erat, non condimentum magna euismod a. Nullam elit eros, placerat sit amet suscipit a, lobortis et orci. Suspendisse eu odio eros. Duis at felis eget massa elementum dapibus. Curabitur aliquam ac metus eget malesuada. Sed mollis condimentum eros ut placerat. In sagittis lobortis metus a pulvinar. Fusce dolor augue, dapibus blandit suscipit ac, mollis id diam. Fusce felis enim, molestie in lacinia a, tristique at risus. Integer ac ante ut lorem egestas tristique.Praesent quis diam sed quam porttitor laoreet non condimentum sem. Integer consequat mauris turpis, cursus feugiat eros scelerisque imperdiet. Aliquam vulputate orci sed erat bibendum placerat non nec lectus. Nunc eget dui nec magna pretium suscipit. Etiam nec odio aliquam, commodo tellus nec, dictum enim. Suspendisse ut sem vulputate justo dictum consequat. Vivamus non magna ut nulla auctor scelerisque ut sit amet diam. Fusce sagittis diam est, in pulvinar purus malesuada ac.Vivamus eu ipsum vel tortor iaculis lobortis. Nulla quis eros vel urna porttitor scelerisque ut et odio. Phasellus eu maximus ipsum. Aenean hendrerit lacus ornare finibus suscipit. Nulla condimentum ipsum in sem laoreet, ut consequat quam efficitur. Nunc libero nulla, dapibus eget ultrices eget, sodales quis urna. Morbi et neque nec nisl vulputate maximus iaculis sit amet urna. In sed diam lorem. Etiam ac tempus magna. In in dignissim elit. Nulla gravida lacinia libero, in tincidunt nibh tempus vitae.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>4.  Objetivo general</strong>
                <p class="text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>5.  Objetivos específicos</strong>
                <p class="text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>6.  Metodología</strong>
                <p class="text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. Donec nunc risus, consectetur vel luctus a, vestibulum elementum massa. Etiam faucibus tellus erat, non condimentum magna euismod a. Nullam elit eros, placerat sit amet suscipit a, lobortis et orci. Suspendisse eu odio eros. Duis at felis eget massa elementum dapibus. Curabitur aliquam ac metus eget malesuada. Sed mollis condimentum eros ut placerat. In sagittis lobortis metus a pulvinar. Fusce dolor augue, dapibus blandit suscipit ac, mollis id diam. Fusce felis enim, molestie in lacinia a, tristique at risus. Integer ac ante ut lorem egestas tristique.Praesent quis diam sed quam porttitor laoreet non condimentum sem. Integer consequat mauris turpis, cursus feugiat eros scelerisque imperdiet. Aliquam vulputate orci sed erat bibendum placerat non nec lectus. Nunc eget dui nec magna pretium suscipit. Etiam nec odio aliquam, commodo tellus nec, dictum enim. Suspendisse ut sem vulputate justo dictum consequat. Vivamus non magna ut nulla auctor scelerisque ut sit amet diam. Fusce sagittis diam est, in pulvinar purus malesuada ac.Vivamus eu ipsum vel tortor iaculis lobortis. Nulla quis eros vel urna porttitor scelerisque ut et odio. Phasellus eu maximus ipsum. Aenean hendrerit lacus ornare finibus suscipit. Nulla condimentum ipsum in sem laoreet, ut consequat quam efficitur. Nunc libero nulla, dapibus eget ultrices eget, sodales quis urna. Morbi et neque nec nisl vulputate maximus iaculis sit amet urna. In sed diam lorem. Etiam ac tempus magna. In in dignissim elit. Nulla gravida lacinia libero, in tincidunt nibh tempus vitae.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>7.  Plan de trabajo</strong>
                <p class="text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. Donec nunc risus, consectetur vel luctus a, vestibulum elementum massa. Etiam faucibus tellus erat, non condimentum magna euismod a. Nullam elit eros, placerat sit amet suscipit a, lobortis et orci. Suspendisse eu odio eros. Duis at felis eget massa elementum dapibus. Curabitur aliquam ac metus eget malesuada. Sed mollis condimentum eros ut placerat. In sagittis lobortis metus a pulvinar. Fusce dolor augue, dapibus blandit suscipit ac, mollis id diam. Fusce felis enim, molestie in lacinia a, tristique at risus. Integer ac ante ut lorem egestas tristique.Praesent quis diam sed quam porttitor laoreet non condimentum sem. Integer consequat mauris turpis, cursus feugiat eros scelerisque imperdiet. Aliquam vulputate orci sed erat bibendum placerat non nec lectus. Nunc eget dui nec magna pretium suscipit. Etiam nec odio aliquam, commodo tellus nec, dictum enim. Suspendisse ut sem vulputate justo dictum consequat. Vivamus non magna ut nulla auctor scelerisque ut sit amet diam. Fusce sagittis diam est, in pulvinar purus malesuada ac.Vivamus eu ipsum vel tortor iaculis lobortis. Nulla quis eros vel urna porttitor scelerisque ut et odio. Phasellus eu maximus ipsum. Aenean hendrerit lacus ornare finibus suscipit. Nulla condimentum ipsum in sem laoreet, ut consequat quam efficitur. Nunc libero nulla, dapibus eget ultrices eget, sodales quis urna. Morbi et neque nec nisl vulputate maximus iaculis sit amet urna. In sed diam lorem. Etiam ac tempus magna. In in dignissim elit. Nulla gravida lacinia libero, in tincidunt nibh tempus vitae.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>8.  Cronograma</strong>
                <p class="text-description">
                    Aquí va el cronograma xd.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>9.  Blibliografía</strong>
                <p class="text-description">
                    Aquí va la bibliografía.
                </p>
            </td>
        </tr>
    </table>
</div>


</body>
</html>
