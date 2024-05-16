<?php

include_once('persona.php');
include_once('pasajero.php');
include_once('pasajeroVIP.php');
include_once('pasajeroEspecial.php');
include_once('responsableViaje.php');
include_once('viaje.php');

$responsable = new ResponsableV("Rodrigo", "Villablanca", 5654, 2112);

$viajecito = new Viaje(13, "Vista Alegre", 2, [], $responsable, 150700, 10); // inicializo la capacidad en bajito para probar el limite

/**
 * ACLARACIÓN: no hice todas las validaciones de comprobación de numeros de asientos o ticket para que no se repitan. Como tampoco utlicé una validacion para que por dni no entraran solo numeros
 */

echo "Bienvenido a Viaje Feliz!\n";
echo "»»»»»»»»»»»»«««««««««««««";

do {
    echo "\n1)Agregar pasajero\n";
    echo "2)Modificar los datos de un pasajero\n";
    echo "3)Modificar los datos del responsable\n";
    echo "4)Ver detalles del viaje\n";
    echo "5)Salir\n";
    echo "Seleccione una opción:\n";

    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            if (!$viajecito->hayPasajesDisponibles()) {
                echo "No hay más boletos!\n";
                break;
            }

            echo "Nombre del pasajero:\n";
            $nombre = trim(fgets(STDIN));
            echo "Apellido del pasajero:\n";
            $apellido = trim(fgets(STDIN));
            echo "Documento del pasajero:\n";
            $documento = trim(fgets(STDIN));
            echo "Teléfono del pasajero:\n";
            $telefono = trim(fgets(STDIN));
            echo "Número de asiento (1-20):\n";
            $numAsiento = trim(fgets(STDIN));
            $ticketGenerado = mt_rand(100000, 999999);
            echo "Su número de ticket es: $ticketGenerado\n";

            echo "Tipo de pasajero:\n";
            echo "1) Estándar\n";
            echo "2) VIP\n";
            echo "3) Especial\n";
            $tipoPasajero = trim(fgets(STDIN));

            switch ($tipoPasajero) {
                case 1:
                    $pasajero = new Pasajero($nombre, $apellido, $documento, $telefono, $numAsiento, $ticketGenerado);
                    $porcentajeIncrementoNormal = $pasajero->darPorcentajeIncremento();
                    echo "El porcentaje es de: " . $porcentajeIncrementoNormal . "\n";
                    $costoNormal = $viajecito->calcularCostoBoleto($pasajero);
                    echo "El boleto cuesta: " . $costoNormal . "\n";
                    break;
                case 2:
                    echo "Número de viajero frecuente:\n";
                    $numViajeroFrec = trim(fgets(STDIN));
                    echo "Cantidad de millas:\n";
                    $cantMillas = trim(fgets(STDIN));
                    $pasajero = new PasajeroVIP($nombre, $apellido, $documento, $telefono, $numAsiento, $ticketGenerado, $numViajeroFrec, $cantMillas);
                    $porcentajeIncrementoVIP = $pasajero->darPorcentajeIncremento();
                    echo "El porcentaje es de: " . $porcentajeIncrementoVIP . "\n";
                    $costoVIP = $viajecito->calcularCostoBoleto($pasajero);
                    echo "Costo del boleto VIP:" . $costoVIP . "\n";
                    break;
                case 3:
                    echo "Requiere silla de ruedas (s/n):\n";
                    $reqSillaRuedas = (trim(fgets(STDIN)) == 's');
                    echo "Requiere asistencia (s/n):\n";
                    $reqAsist = (trim(fgets(STDIN)) == 's');
                    echo "Requiere comida especial (s/n):\n";
                    $reqComidaEspecial = (trim(fgets(STDIN)) == 's');
                    $pasajero = new PasajeroEspecial($nombre, $apellido, $documento, $telefono, $numAsiento, $ticketGenerado, $reqSillaRuedas, $reqAsist, $reqComidaEspecial);
                    $porcentajeIncrementoEspecial = $pasajero->darPorcentajeIncremento();
                    echo "El porcentaje es de: " . $porcentajeIncrementoEspecial . "\n";
                    $costoEspecial = $viajecito->calcularCostoBoleto($pasajero);
                    echo "Costo viaje especial: $costoEspecial\n";
                    break;
                default:
                    echo "Oopcion inválida\n";
                    break;
            }

            if ($viajecito->agregarPasajero($pasajero)) {
                echo "Pasajero agregado exitosamente!\n";
            } else {
                echo "El pasajero ya se encuentra en el sistema o no quedan lugares disponibles.\n";
            }
            break;
        case 2:
            echo "Ingrese el DNI, el asiento o ticket del pasajero a modificar:\n";
            $documentoModificar = trim(fgets(STDIN));
            echo "Ingrese el nombre:\n";
            $nombreNuevo = trim(fgets(STDIN));
            echo "Ahora el apellido:\n";
            $apellidoNuevo = trim(fgets(STDIN));
            echo "Ingrese el telefono:\n";
            $telefonoNuevo = trim(fgets(STDIN));
            echo "Ingrese el asiento:\n";
            $asientoNuevo = trim(fgets(STDIN));
            $ticketReGenerado = mt_rand(100000, 999999);
            echo "Su nuevo número de ticket es: $ticketReGenerado\n";
            $pasajeroNuevo = new Pasajero($nombreNuevo, $apellidoNuevo, $documentoModificar, $telefonoNuevo, $asientoNuevo, $ticketReGenerado);
            if ($viajecito->modificarPasajero($pasajeroNuevo)) {
                echo "Enhorabuena!! Los datos fueron modificados\n";
            } else {
                echo "El pasajero con documento $documentoModificar no se encuentra en el sistema!\n";
            }
            break;
        case 3:
            echo "Ingrese el Número de Empleado o el Número de Licencia del Responsable:\n";
            $numAModificar = trim(fgets(STDIN));
            echo "Ingrese el nombre:\n";
            $nombreResponNuevo = trim(fgets(STDIN));
            echo "Ahora el apellido:\n";
            $apellidoResponNuevo = trim(fgets(STDIN));
            echo "Ingrese el nuevo Número de Empleado:\n";
            $nuevoNumEmpleado = trim(fgets(STDIN));
            echo "Ingrese el nuevo Número de Licencia:\n";
            $nuevoNumLicencia = trim(fgets(STDIN));
            $responsableNuevo = new ResponsableV($nuevoNumEmpleado, $nuevoNumLicencia, $nombreResponNuevo, $apellidoResponNuevo);
            if ($viajecito->modificarResponsable($numAModificar, $responsableNuevo)) {
                echo "Modificaste los datos del Responsable exitosamente!\n";
            } else {
                echo "El $numAModificar no pertenece a ningún Responsable\n";
            }
            break;
        case 4:
            echo $viajecito;
            break;
        case 5:
            echo "Adiós!";
            break;
        default:
            echo "Opción inválida\n";
    }
} while ($opcion != 5);
