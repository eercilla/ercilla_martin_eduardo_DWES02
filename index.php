<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reservas de Vehículos</title>
</head>
<body>
    <header>
        <h1>Gestión de Reservas de Vehículos</h1>
    </header>

    <main>
        <!-- Sección de Introducción de Datos -->
            <form id="formulario" action="validar.php" method="post">
                <h3>Introducir datos del usuario</h3>
                

                <label>Nombre: </label>
                <input type="text" name="nombre">

                <br><label>Apellido: </label>
                <input type="text" name="apellido">

                <br><label>DNI: </label>
                <input type="text" name="dni">

                <hr>

                <h3>Reserva</h3>

                <label>Modelo del Vehículo</label>
                <select name="modelo">
                    <option>Lancia Stratos</option>
                    <option>Audi Quattro</option>
                    <option>Ford Escort RS1800</option>
                    <option>Subaru Impreza 555</option>
                </select>

                <br><label>Fecha de Inicio de la Reserva</label>
                <!-- <input type="date" id="date" name="date" min="2010-01-01" max="2020-12-31" required> -->
                <input type="date" id="fecha" name="fecha">
                <br><label>Duración de la Reserva (en días): </label>
                <input type="number" id="duracion" name="duracion" required>

                <br></br><button type="submit" name="enviar">Reservar</button>
            </form>
    </main>
</body>
</html>