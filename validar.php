<?php
    session_start();

    // Guardamos en el array de sesión "miSesión" los valores introducidos en el formulario
    $_SESSION['miSesion'] = array();
    $_SESSION['miSesion']['nombre']=$_POST['nombre'];
    $_SESSION['miSesion']['apellido']= $_POST['apellido'];
    $_SESSION['miSesion']['dni']=$_POST['dni'];
    $_SESSION['miSesion']['modelo']=$_POST['modelo'];
    $_SESSION['miSesion']['fecha']= $_POST['fecha'];
    $_SESSION['miSesion']['duracion']=(int)$_POST['duracion'];



    // Incluimos "usuarios_y_coches.php" para poder acceder a los coches y usuarios almacenados
    include 'usuarios_y_coches.php';

        //Guardamos en variables los datos del formulario para manejarlos con más facilidad
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $modelo = $_POST['modelo'];
        $fechaInicio = $_POST['fecha'];
        $duracion = (int)$_POST['duracion'];

        // Guardamos en el array auxiliar de sesión "miSesión2" si cumple o no las condiciones pedidas
        // en cada campo

        $_SESSION['miSesion2'] = array();
        $_SESSION['miSesion2']['nombre']=tieneNombre($nombre);
        $_SESSION['miSesion2']['apellido']= tieneApellido($apellido);
        $_SESSION['miSesion2']['dni']=validarDNI($dni);
        $_SESSION['miSesion2']['fecha']= validarFecha($fechaInicio);
        $_SESSION['miSesion2']['duracion']=duracionCorrecta($duracion);
        $_SESSION['miSesion2']['usuario']=validarUsuario($dni, $nombre, $apellido);
        $_SESSION['miSesion2']['coche']=validarCoche($modelo, $fechaInicio);




    // Si cumple todas las condiciones
    if (tieneNombre($nombre) && tieneApellido($apellido) && duracionCorrecta($duracion) && validarUsuario($dni, $nombre, $apellido)
    && validarFecha($fechaInicio) && validarCoche($modelo, $fechaInicio)){

        // Abre ok.php
        $url = 'http://localhost/ev02/ok.php';
        header('Location: '.$url);

}


    // Si alguna condición no es correcta
    else{

        // Abre ok.php
        $url = 'http://localhost/ev02/notok.php';
        header('Location: '.$url);

    }

    // Función para comprobar si el campo "Nombre" está vacío
    function tieneNombre($nombre){
        if (isset($_POST['enviar']) && empty($nombre)){
 
            return false;
        }
        return true;
    }
    
    // Función para comprobar si el campo "Apellido" está vacío
    function tieneApellido($apellido){
        if (isset($_POST['enviar']) && empty($apellido)){
 
            return false;
        }
        return true;
    }

    // Función para comprobar si la duración es correcta
    function duracionCorrecta($duracion){
        
        if($duracion>30 || $duracion < 1){
            return false;
        }
        return true;
    }

    // Función para comprobar si el dni es correcto
    function validarDNI($dni) {
        
        
        // No tiene 9 caracteres
        if(strlen($dni)!=9){
            return false;
        }


        // Array de letras para aplicar módulo 23
        $arrayAsignacion = 'TRWAGMYFPDXBNJZSQVHLCKE';

        // Obtenemos el número del DNI sin la letra
        $numero = substr($dni, 0, -1);

        // Obtenemos la letra del DNI
        $letra = substr($dni, -1);

        // Comprobamos que lo introducido sea un número. **En caso de empezar por un número, si luego hay
        // caracteres no serviría ya que cogería el número hasta el string.
        if(!intval($numero)){
            return false;
        }

        // Convertimos para que no muestre warnings en caso de haber caracteres
        $numero = intval($numero);

        // Obtenemos la posición en el array de letras
        $posicion = $numero % 23;
        
        // Compara si la letra del DNI introducido y la que correspondería aplicando módulo 23 coinciden
        return strtoupper($letra) === $arrayAsignacion[$posicion];
    }

    // Función para comprobar si el usuario está almacenado en la base de datos
    function validarUsuario($dni, $nombre, $apellido){

        global $USUARIOS;

        // Recorremos cada usuario de USUARIOS
        foreach(USUARIOS as $usuario){
            
            // Si tenemos almacenado un usuario con el DNI, nombre y apellido introducidos
            if ($usuario["dni"]===strtoupper($dni) && strtoupper($usuario["nombre"])===strtoupper($nombre) && strtoupper($usuario["apellido"])===strtoupper($apellido)){
                return true;
            }
        }

        // Si no hay ningún usuario con el DNI, nombre y apellido introducidos
        return false;
    }

    // Función para comprobar si la fecha es posterior al día actual
    function validarFecha($fechaInicio) {
        $fechaActual = date('Y-m-d');

        return $fechaInicio > $fechaActual;
    }

    // Función para comprobar si el coche existe (va a existir siempre al ser un desplegable)
    //  
    function validarCoche($modelo, $fechaInicio){
        global $coches;

        // Recorremos el array de coches del fichero
        foreach($coches as $coche){


            // Si el modelo introducido corresponde a alguno del array de la base de datos
            if ($coche["modelo"]===$modelo){
                
                // Comprobamos si ahora mismo figure como disponible
                if($coche["disponible"]){
                    return true;
                }else{ //No disponible actualmente
                    
                    // Comprobamos que en la fecha introducida pueda haber pasado al estado disponible
                    if($fechaInicio>$coche["fecha_fin"]){
                        return true;
                    }else{ // Si no está disponible en la fecha solicitada
                        return false;
                    }
                }
            }
        }
        
        // Si el vehículo no existe en el array de coches
        return false;
    }
?>