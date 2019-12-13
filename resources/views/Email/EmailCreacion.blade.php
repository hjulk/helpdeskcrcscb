<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/font-awesome/css/font-awesome.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/Ionicons/css/ionicons.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/AdminLTE.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/skins/_all-skins.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/$theme/CodeSeven/build/toastr.min.css")}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<div class="row">
    <div class="col-md-12">
        <br>
        <table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;font-family:Verdana;font-size:13px;' class='tg' cellpadding='5'>
    <colgroup>
        <col style='width: 200px'>
        <col style='width: 500px'>
    </colgroup>
    <tr>
        <th colspan='2'>Creación de Ticket</th>
    </tr>
    <tr height='20px'></tr>
    <tr>
        <td><b>No. Ticket:</b></td>
        <td>{{$Ticket}}</td>
    </tr>

    <tr>
        <td><b>Categoria:</b></td>
        <td>{{$Categoria}}</td>
    </tr>

    <tr>
        <td><b>Prioridad:</b></td>
        <td>{{$Prioridad}}</td>
    </tr>

    <tr>
        <td><b>Asunto:</b></td>
        <td>{{$Asunto}}</td>
    </tr>

    <tr>
        <td><b>Descripción:</b></td>
        <td style="text-align: justify;">{{$Mensaje}}</td>
    </tr>
    <tr>
        <td><b>Nombre de quien reporta:</b></td>
        <td>{{$NombreReportante}}</td>
    </tr>

    <tr>
        <td><b>Telefono:</b></td>
        <td>{{$Telefono}}</td>
    </tr>

    <tr>
        <td><b>Correo:</b></td>
        <td>{{$Correo}}</td>
    </tr>

    <tr>
        <td><b>Asignado a:</b></td>
        <td>{{$AsignadoA}}</td>
    </tr>

    <tr>
        <td><b>Estado Ticket:</b></td>
        <td>{{$Estado}}</td>
    </tr>

    <tr>
        <td><b>Fecha Creación:</b></td>
        <td>{{$Fecha}}</td>
    </tr>
</table>
<br>
<br>
@if($Calificacion === 1)
    <table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;font-family:Verdana;font-size:13px;' class='tg' cellpadding='5'>
        <colgroup>
            <col style='width: 50px'>
            <col style='width: 50px'>

        </colgroup>
        <tbody>
            <tr>
                <td>{{$Calificacion2}}</td>
                <td>{{$Calificacion1}}</td>
            </tr>
            <tr>

                <td>No Me Gusta</td>
                <td>Me Gusta</td>
            </tr>
        </tbody>
    </table>
@endif
<br>
<table border="1" cellspacing="0" style="margin:0px;color:rgb(97,97,97);font-family:&quot;Open Sans&quot;;font-size:14px;border-collapse:collapse;border-color:transparent;border-width:0px">
        <tbody>
            <tr>
                <td style="vertical-align:top;width:32px">
                    &nbsp;<img border="0" src="https://ci3.googleusercontent.com/proxy/MFm503cf7ouvsT7kbgCpQ8BYPUuJ30jkbprUamyBQvciextFs3wAWrPlTXnWdMde-wtAl8Peka1ur63Pzx9y47WuNG12YkcTNwisjRzA=s0-d-e1-ft#https://storage.googleapis.com/efor-static/SERS/FIRMA12.png" class="CToWUd">
                </td>
                <td style="vertical-align:top;width:62px">
                    <font color="#085ca2"><b>Mesa de Ayuda</b>
                    </font><br style="color:rgb(8,92,162)"><b style="color:rgb(8,92,162)"><font color="#000000">Gestión TIC
                        <br>Unión Temporal Servisalud San José
                        <br>Tel 744 0981 ext 115</font></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="vertical-align:top;width:60px">
                        <img src="https://ci3.googleusercontent.com/proxy/lA4xY8CR5DU5xdhI4bZI21Qn48AFd839HYayu1sRV9C7rbuvGBevzePrLRVkof3jyYNxKOkA8Ky98-Jpaz6-J7FmsWSMRf_3oqUKgM7p=s0-d-e1-ft#https://storage.googleapis.com/efor-static/SERS/FIRMA11.png" usemap="#m_3620493203722104036_SignatureSanitizer_m_-8559001894841881195_SignatureSanitizer_image-map" class="CToWUd">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
