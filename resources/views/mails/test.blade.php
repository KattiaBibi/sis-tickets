<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>Invitacion a la reunion {{$cita->titulo}}</title>
</head>

<body>
  <p>Hola!, {{$asistente->nombres}} {{$asistente->apellidos}}, el anfitrion de la reunion <strong>{{$cita->registrado_por}}</strong>, te agendo en la reunion: <strong>{{$cita->titulo}}</strong> que se llevara a cabo la fecha: <strong>{{date('d/m/Y', strtotime($cita->fecha))}}</strong> desde las <strong>{{date('h:i A', strtotime($cita->fecha_inicio))}}</strong> hasta las <strong>{{date('h:i A', strtotime($cita->fecha_fin))}}</strong> y solicitamos confirmes tu asistencia:</p>
  <p>
    <span>¿Confirmas tu asistencia?</span>
    <br>
    <a href="{{url('/')}}/cita/confirmar-asistencia?respuesta=SI&detalle_cita_id={{$asistente->detalle_cita_id}}&hash={{password_hash($asistente->detalle_cita_id, PASSWORD_DEFAULT)}}" target="_blank">SI</a>
    <br>
    <a href="{{url('/')}}/cita/confirmar-asistencia?respuesta=NO&detalle_cita_id={{$asistente->detalle_cita_id}}&hash={{password_hash($asistente->detalle_cita_id, PASSWORD_DEFAULT)}}" target="_blank">NO</a>
  </p>
</body>

</html>