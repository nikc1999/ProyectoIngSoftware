<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Estimado estudiante</h3>

    <p>Su solicitud N°{{$solicitud->id}} de tipo {{$solicitud->tipo}}: {{$solicitud->tipo_facilidad}} fue {{$solicitud->estado}}</p>

    <p>El comentario del jefe de carrera fue el siguiente: </p>

    <p>{{$solicitud->detalles_jefe_carrera}}</p>

    <p>Para más información consultar por correo EjemploAdministración@ucn.cl</p>

</body>
</html>
