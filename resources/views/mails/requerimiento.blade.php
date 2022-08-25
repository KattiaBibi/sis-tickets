<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>Asignación al requerimiento: {{ strtoupper($requerimiento->titulo) }}</title>
</head>

<body>

  <?php
  $encargados = "";
  foreach ($requerimiento->encargados as $encargado) {
    $encargados .= $encargado->nom_ape_encargado . ', ';
  }

  $asignados = "";
  foreach ($requerimiento->asignados as $asignado) {
    $asignados .= $asignado->nom_ape_asignado . ', ';
  }
  ?>

  <p>👉 Hola!, {{ strtoupper($colaborador->nombre) }} {{ strtoupper($colaborador->apellido) }}, tienes un requerimiento pendiente. <br>

    <strong>✅ TITULO: </strong> {{ strtoupper($requerimiento->titulo) }} <br>
    <strong>✅ SOLICITANTE: </strong> {{ $requerimiento->nom_ape_solicitante }} <br>
    <strong>✅ EMPRESA SOLICITANTE: </strong> {{ strtoupper($requerimiento->nombre_empresa) }} <br>
    <strong>✅ PRIORIDAD: </strong> {{ strtoupper($requerimiento->prioridad) }} <br>
    <strong>✅ SERVICIO: </strong> {{ strtoupper($requerimiento->nombre_servicio) }} <br>
    <strong>✅ FECHA CREACION: </strong> {{ $requerimiento->fecha_creacion }} <br>
    <strong>✅ ENCARGADO(S): </strong> {{ !empty($encargados) ? $encargados : '---' }} <br>
    <strong>✅ ASIGNADO(S): </strong> {{ !empty($asignados) ? $asignados : '---' }} <br>

  </p>

</body>

</html>