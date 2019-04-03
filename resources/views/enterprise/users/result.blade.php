<style>
    * {
        box-sizing: border-box;
    }
    body {
        max-width: 700px;
        max-height: 1400px;
        margin-right: auto;
        margin-left: auto;
        padding-top: 20px;
        padding-bottom: 40px;
    }
   
    .bg-blue {
        background: #0e71b5;
        padding: 10px;
        margin-top: 20px;
    }
    .bg-blue h1 {
        font: bold 32px Helvetica, Arial, sans-serif;
        color: #ffffff;line-height: 42px;
        margin: 0;
    }
    .bg-blue h2 {
        margin: 0;
        font: bold 30px Helvetica, Arial, sans-serif;
        color: #ffffff;line-height: 42px;
    }

    .border-blue {
        border: 1px solid #256d9b;
        padding: 10px;
        margin-top: 30px;
        margin-bottom: 230px;
    }

    p {
        font: 16px Helvetica, Arial, sans-serif;
        line-height: 20px;
    }
    .border-blue p{
        font: 11px Helvetica, Arial, sans-serif !important;
    }
    .page {
        padding-bottom: 50px;
    }
    .border {
        border: 1px solid;
        margin-top: 40px;
        font: normal 16px Helvetica, Arial, sans-serif;
    }

    .border h1{
        font: normal 30px Helvetica, Arial, sans-serif;
    }
    .result {
        display: block;
        padding: 5px;
    }
    .result-child {
        border-width: 1px;
        border-style: solid;
        text-align: center;
        width: 100%;
    }
    .result-child .above {
        padding: 10px;
    }
    .result-child .above td{
        padding: 10px;
        height: 281px;
    }
    .result-child .bottom {
        padding: 10px;
    }
    .result-child .bottom td{
        height: 211px;
    }
    .result-child h5 {
        color: #fff;
        font: 16px Helvetica, Arial, sans-serif;
        font-weight: bold;
    }
</style>

<div>
    <div style="text-align: right">
        <table width="100%">
            <tr>
                <td width="50%" valign="middle" align="left">
                    <img src="{{ asset('neuro.jpg') }}" width="140px">
                </td>
                <td width="50%" valign="middle" align="right">
                    <img src="{{ asset('logocentrum.png') }}" width="140px">
                </td>
            </tr>
        </table>
    </div>

    <div class="bg-blue">
        <h1>REPORTE DE PARTICIPACIÓN EN EL NEUROLEADERSHIPLAB</h1>
        <br>
        <h2>{{ $user->name }} {{ $user->lastName }}</h2>
        <h2>{{ $date }}</h2>
    </div>

    <div class="border-blue">
        <p>El presente documento reporta los resultados de tu participación en el NeuroLeadershipLab (NLL).
        Esta experiencia tiene como objetivo poner en tu conocimiento cómo despliegas competencias
        asociadas al liderazgo en una situación que es similar a contextos corporativos, donde se requiere
        actuar con velocidad pero teniendo en cuenta múltiples variables. Un objetivo adicional es conocer
        cómo activaste dos tipos de procesos cognitivos muy necesarios para ser un buen líder: el observar
        aquello que está sucediendo y el reflexionar cómo solucionar las situaciones planteadas.</p>
        <p>Te hacemos llegar el reporte de tu participación, el cual agrupa tu desempeño en cinco competencias.
        Cada competencia está definida en la parte superior de la tabla.</p>
        <p>La primera columna de la izquierda indica tu desempeño en la competencia, el cual se extrae de las
        preguntas que respondiste. Hay cuatro niveles: En inicio / En proceso / Logro previsto y Logro
        destacado. Las tres siguientes columnas. Este resultado refleja cómo desplegaste la competencia en
        el caso que se te presentó.</p>
        <p>Las tres siguientes columnas te informan cuál fue tu actividad cerebral durante cada una de las
        secuencias asociadas a las competencias. Con “actividad cerebral” nos referimos al tipo de
        procesamiento cognitivo que mostraste en tres momentos: mientras veías los vídeos, mientras
        reflexionabas y mientras tomabas decisiones (respondiendo las preguntas). Se espera que mientras
        veías el vídeo tu atención esté en la pantalla, en lo externo. Y se espera que mientras reflexionabas o
        tomabas decisiones estés concentrado y tu foco esté en lo interior. Por ello, para las actividades
        cerebrales solo hay dos posibles resultados: adecuado o inadecuado, si se cumple cono lo esperado o
        no.</p>
        <p>Te invitamos a reflexionar cómo te has desempeñado en cada competencia y cómo fue tu actividad
        cerebral. A veces, te parecerá que estas no guardan relación entre ellas y otras que parece que la
        relación es directa. Sin embargo, la relación entre desempeño y actividad cerebral se puede establecer
        por tu nivel de experticia en la tarea, por tu nivel de compromiso con esta o con otras habilidades que
        tengas asociadas a la competencia que hagan activar tus procesos de forma particular.</p>
        <p>Nota que la competencia de trabajo en equipo no tiene un momento de reflexión pues esta se evaluó
        de forma transversal (es decir, durante toda la prueba).</p>
    </div>
</div>

@foreach ($result as $r)
    @component('enterprise.users.competence', [
        'result' => $r,
        'competence' => \App\Entities\Competence::find($r->competenceId)
        ])
    @endcomponent
    <br>
@endforeach
