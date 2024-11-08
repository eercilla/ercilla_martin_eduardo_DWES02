<?php

    session_start();

    // Guardamos en variables los valores del array de sesión
    if(isset($_SESSION['miSesion'])){
        $nombre = $_SESSION['miSesion']['nombre'];
        $apellido = $_SESSION['miSesion']['apellido'];
        $dni = $_SESSION['miSesion']['dni'];
        $modelo = $_SESSION['miSesion']['modelo'];
        $fechaInicio = $_SESSION['miSesion']['fecha'];
        $duracion = $_SESSION['miSesion']['duracion'];
    } else{
         echo "<h2>Ha ocurrido algún error en el procesamiento de datos</h2>";
    }


    // Nos muestra un mensaje y la imagen del coche
    
        echo "<h2> Gracias, ".$nombre." ".$apellido.", por reservar con nosotros.</h2>";
        $modelAux = str_replace(" ", "_", $modelo);
        echo "<img src=img/".$modelAux.".jpg>";

    // Destruimos la sesión
    session_destroy();
?>