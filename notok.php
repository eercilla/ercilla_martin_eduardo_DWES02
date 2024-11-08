<?php
    session_start();

    // Guardamos en variables los valores del array de sesión.
    if(isset($_SESSION['miSesion'])){
        $nombre = $_SESSION['miSesion']['nombre'];
        $apellido = $_SESSION['miSesion']['apellido'];
        $dni = $_SESSION['miSesion']['dni'];
        $modelo = $_SESSION['miSesion']['modelo'];
        $fechaInicio = $_SESSION['miSesion']['fecha'];
        $duracion = $_SESSION['miSesion']['duracion'];
    }else{
        echo "<h2>Ha ocurrido algún error en el procesamiento de datos</h2>";
   }

echo "<h2> Se han producido errores en los siguientes campos: </h2> <hr>";

        // Comprobamos uno por uno si son true o false todos los valores del array auxiliar de sesion "miSesion"

        // Si el usuario introducido no está en la base de datos
        if(!$_SESSION['miSesion2']['usuario'] || !$_SESSION['miSesion2']['nombre'] || !$_SESSION['miSesion2']['apellido']){
            echo "<span style='background-color:red'> El usuario no es válido</span><br><br>";
        }

        // Si no se ha introducido el nombre
        if(!$_SESSION['miSesion2']['nombre']){
            echo "<span style='background-color:red'> El nombre está vacío </span><br>";
        } else{
            echo "<span style='background-color:green'> Nombre: ".$nombre."</span><br>";
        }

        // Si no se ha introducido el apellido
        if(!$_SESSION['miSesion2']['apellido']){
            echo "<span style='background-color:red'> El apellido está vacío </span><br>";
        } else{
            echo "<span style='background-color:green'> Apellido: ".$apellido."</span><br>";
        }
    
        // Si la duración no es correcta
        if(!$_SESSION['miSesion2']['duracion']){
            echo "<span style='background-color:red'> La duración debe ser mayor o igual que 1 y menor o igual que 30</lispan><br>";
        } else{
            echo "<span style='background-color:green'> Duración: ".$duracion."</span><br>";
        }

        // Si el dni introducido no cumple modulo 23 o no es válido
        if (!$_SESSION['miSesion2']['dni']){
            echo "<span style='background-color:red'> El DNI ".$dni." no es válido </span><br>";
        } else{
            echo "<span style='background-color:green'> DNI: ".$dni."</span><br>";
        }

        // Si la fecha no es posterior a la actual
        if(!$_SESSION['miSesion2']['fecha']){
            echo "<span style='background-color:red'> La fecha seleccionada debe de ser posterior a la actual: ".date('Y-m-d')." </span><br>";
        } else{
            echo "<span style='background-color:green'> Fecha: ".$fechaInicio."</span><br>";
        }

        // Si el modelo de coche introducido no está disponible
        if(!$_SESSION['miSesion2']['coche']){
            echo "<span style='background-color:red'> El modelo: ".$modelo." no está disponible </span><br>";
        } else{
            echo "<span style='background-color:green'> El modelo: ".$modelo." está disponible </span><br>";
        }
    
    // Destruimos la sesión
    session_destroy();
?>