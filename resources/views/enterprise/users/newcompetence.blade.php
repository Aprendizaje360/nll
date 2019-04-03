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
  
    
    <div class="border" style="border-color: {{ $color }}" >
        <div style="padding: 10px;">
            <h1>{{ $competence->label }}</h1>
            <p>
                {{ $competence->description }}
            </p>
        </div>
        <table>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </table>
    </div>
</div>