<div class="page">
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
    <?php 
        $color = "#000";
        switch ($result->competenceId) {
            case 17:
                $color = '#622181';
                break;
            case 18:
                $color = '#0e72b5';
                break;
            case 19:
                $color = '#f8b333';
                break;
            case 20:
                $color = '#e2001a';
                break;
            case 21:
                $color = '#828265';
                break;
            
            default:
                break;
        }
    ?>
    
    <div class="border" style="border-color: {{ $color }}" >
        <div style="padding: 10px;">
            <h1>{{ $competence->label }}</h1>
            <p>
                {{ $competence->description }}
            </p>
        </div>
        <table>
            <tr>
                <td style="width: 24%;">
                    <div class="result" style="border-color: {{ $color }}">
                        <table class="result-child">
                            <tr class="above" style="background: {{ $color }}">
                                <td>
                                    <img src="{{ asset('icons/skill.png') }}" alt="">
                                    <h5>
                                        Despliegue de la competencia
                                    </h5>
                                </td>
                            </tr>
                            <tr class="bottom">
                                <td>
                                    <img src="{{ asset('icons/'.$result->label.'.png') }}" alt="">
                                    <p>{{ $result->label }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td style="width: 24%;">
                    <div class="result" style="border-color: {{ $color }};">
                        <table class="result-child">
                            <tr class="above"  style="background: {{ $color }}">
                                <td style="opacity: 0.6;">
                                    <img src="{{ asset('icons/boy-with-3d-spectacles-at-cinema_white.png') }}" alt="">
                                    <h5>
                                        Actividad cerebral durante la observación de los vídeos
                                    </h5>
                                </td>
                            </tr>
                            <tr class="bottom">
                                <td style="opacity: 0.6;">
                                    @if ($result->watching == 'Beta')
                                        <img src="{{ asset('icons/Bueno.png') }}" alt="">
                                        <p>Atención externa adecuada</p>
                                        
                                    @else
                                        <img src="{{ asset('icons/Malo.png') }}" alt="">
                                        <p>Atención externa inadecuada</p>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td style="width: 24%; ">
                    @if (isset($result->reflecting))
                    <div class="result" style="border-color: {{ $color }};">
                        <table class="result-child">
                            <tr class="above"  style="background: {{ $color }}">
                                <td style="opacity: 0.6;">
                                    <img src="{{ asset('icons/idea_white.png') }}" alt="">
                                    <h5>
                                        Actividad cerebral durante la reflexión
                                    </h5>
                                </td>
                            </tr>
                            <tr class="bottom">
                                <td style="opacity: 0.6;">
                                @if ($result->reflecting == 'Alpha')
                                    <img src="{{ asset('icons/Bueno.png') }}" alt="">
                                    <p>Concentración adecuada</p>
                                @else
                                    <img src="{{ asset('icons/Malo.png') }}" alt="">
                                    <p>Concentración inadecuada</p>
                                @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    @endif
                </td>
                <td style="width: 24%; ">
                    <div class="result" style="border-color: {{ $color }};">
                        <table class="result-child">
                            <tr class="above"  style="background: {{ $color }}">
                                <td style="opacity: 0.6;">
                                    <img src="{{ asset('icons/answer_white.png') }}" alt="">
                                    <h5>
                                        Actividad cerebral durante la toma de decisiones
                                    </h5>
                                </td>
                            </tr>
                            <tr class="bottom">
                                <td style="opacity: 0.6;">
                                @if ($result->responding == 'Alpha')
                                    <img src="{{ asset('icons/Bueno.png') }}" alt="">
                                    <p>Concentración adecuada</p>
                                @else
                                    <img src="{{ asset('icons/Malo.png') }}" alt="">
                                    <p>Concentración inadecuada</p>
                                @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>