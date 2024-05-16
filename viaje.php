<?php

class Viaje
{
    // atributos
    private $codigoDestino;
    private $destino;
    private $cantidadMaxPasajeros;
    private $colPasajeros; // array de pasajeros
    private $objResponsableViaje;
    private $costoViaje;
    private $sumaCostosAbonados;

    public function __construct($codViaje, $destino, $cantMaxPasajero, $colPasajeros, $responsable, $costoViaje, $sumaCostosAbonados)
    {
        $this->codigoDestino = $codViaje;
        $this->destino = $destino;
        $this->cantidadMaxPasajeros = $cantMaxPasajero;
        $this->colPasajeros = $colPasajeros;
        $this->objResponsableViaje = $responsable;
        $this->costoViaje = $costoViaje;
        $this->sumaCostosAbonados = $sumaCostosAbonados;
    }

    // getters
    public function getCodViaje()
    {
        return $this->codigoDestino;
    }
    public function getDestino()
    {
        return $this->destino;
    }
    public function getMaxPasajero()
    {
        return $this->cantidadMaxPasajeros;
    }
    public function getColPasajero()
    {
        return $this->colPasajeros;
    }

    public function getObjResponsableViaje()
    {
        return $this->objResponsableViaje;
    }

    public function getCostoViaje()
    {
        return $this->costoViaje;
    }

    public function getSumaCostosAbonados()
    {
        return $this->sumaCostosAbonados;
    }

    //setterss
    public function setCodViaje($codViaje)
    {
        $this->codigoDestino = $codViaje;
    }
    public function setDestino($destino)
    {
        $this->destino = $destino;
    }
    public function setMaxPasajero($cantMaxPasajero)
    {
        $this->cantidadMaxPasajeros = $cantMaxPasajero;
    }
    public function setObjPasajero($colPasajeros)
    {
        $this->colPasajeros = $colPasajeros;
    }

    public function setObjResponsableViaje($responsable)
    {
        $this->objResponsableViaje = $responsable;
    }

    public function setCostoViaje($costoViaje)
    {
        $this->costoViaje = $costoViaje;
    }
    public function setSumaCostosAbonados($sumaCostosAbonados)
    {
        $this->sumaCostosAbonados = $sumaCostosAbonados;
    }

    /**
     * agrego al pasajero
     * si no está y hay espacio, se agrega el pasajero al array
     * @return boolean
     */
    public function agregarPasajero($pasajero)
    {
        $agregado = false;

        if (count($this->getColPasajero()) < $this->getMaxPasajero()) {
            if (!$this->verificarPasajero($pasajero)) {
                $coleccionP = $this->getColPasajero();
                $coleccionP[] = $pasajero;
                $this->setObjPasajero($coleccionP); // NO OLVIDARSELO!! 2hs buscando el error
                $agregado = true;
            }
        }
        return $agregado;
    }

    /**
     * valido si existe el pasajero
     * @return boolean
     * recorro array parcial, asi solo llego hasta donde coincidan los datos y no recorro todo sin neceisadad
     */
    public function verificarPasajero($pasajero)
    {
        $pasajeroEnLista = false;
        $numPasajeros = count($this->getColPasajero());
        $i = 0;

        while ($i < $numPasajeros && !$pasajeroEnLista) {
            $pasajeroLista = $this->getColPasajero()[$i]; // Pasajero actual en la lista
            if ($pasajeroLista->getNumDoc() == $pasajero->getNumDoc()) { // Comparando el número de documento
                $pasajeroEnLista = true;
            }
            $i++;
        }
        return $pasajeroEnLista;
    }

    /**
     * modificar pasajero
     * @return boolean
     * recorro array parcial
     */
    public function modificarPasajero($pasajeroAModificar)
    {
        $pasajeroEnListaEncontrado = false;
        $i = 0;
        $coleccionP = $this->getColPasajero();
        $cantPasajeros = count($this->getColPasajero());

        while ($i < $cantPasajeros && !$pasajeroEnListaEncontrado) {
            $pasajeroLista = $coleccionP[$i];
            if ($pasajeroLista->getNumDoc() == $pasajeroAModificar->getNumDoc() || $pasajeroLista->getNumAsiento() == $pasajeroAModificar->getNumAsiento() || $pasajeroLista->getNumTicket() || $pasajeroAModificar->getNumTicket()) {
                $pasajeroLista->setNombre($pasajeroAModificar->getNombre());
                $pasajeroLista->setApellido($pasajeroAModificar->getApellido());
                $pasajeroLista->setTel($pasajeroAModificar->getTel());
                $pasajeroLista->setNumAsiento($pasajeroAModificar->getNumAsiento());
                $pasajeroLista->setNumTicket($pasajeroAModificar->getNumTicket());
                $pasajeroEnListaEncontrado = true;
            }
            $i++;
        }
        return $pasajeroEnListaEncontrado;
    }

    public function hayPasajesDisponibles()
    {
        $disponibilidad = false;
        $arrPasajeros = $this->getColPasajero();
        $enum = count($arrPasajeros);
        $pasajerosMax = $this->getMaxPasajero();

        if ($enum < $pasajerosMax) {
            $disponibilidad = true;
        }

        return $disponibilidad;
    }

    public function venderPasaje($objPasajeros)
    {
        $pasajeVendido = null;
        if ($this->hayPasajesDisponibles()) {
            $this->agregarPasajero($objPasajeros);
            $costoFinal = $this->calcularCostoFinal();
            $this->setSumaCostosAbonados($costoFinal);
            $pasajeVendido = 1;
        }

        return $pasajeVendido;
    }

    public function calcularCostoFinal()
    {
        $costoPasaje = $this->calcularCostoPasaje();
        $sumatoria = $this->getSumaCostosAbonados();
        $costoFinal = $costoPasaje + $sumatoria;

        return $costoFinal;
    }

    // no se si privada o publica cambia algo
    private function calcularCostoPasaje()
    {
        $costoBase = $this->getCostoViaje();
        $cantidadPasajeros = count($this->colPasajeros);

        $costoPasaje = $costoBase * $cantidadPasajeros;

        return $costoPasaje;
    }

    /**
     * moodificar responsable
     * @return boolean
     */
    public function modificarResponsable($numAModificar, $responsableAModificar)
    {
        $responsableEncontrado = false;
        $responsable = $this->getObjResponsableViaje();

        if ($responsable->getNumEmpleado() == $numAModificar || $responsable->getNumLicencia() == $numAModificar) { // Comparo que siempre cumpla al menos una condicion. De esa manera puede ingresar Licencia o Empleado y compararlo.
            // luego aca modifico absolutamente todos los datos, ya que si el nombre cambia, la numLicencia&&numEmpleado tambien.
            $responsable->setNumEmpleado($responsableAModificar->getNumEmpleado());
            $responsable->setNumLicencia($responsableAModificar->getNumLicencia());
            $responsable->setNombreEmpleado($responsableAModificar->getNombreEmpleado());
            $responsable->setApellidoEmpleado($responsableAModificar->getApellidoEmpleado());
            $responsableEncontrado = true;
        }
        return $responsableEncontrado;
    }

    // Propiedades y métodos existentes...

    public function calcularCostoBoleto($objPasajero)
    {
        $porcentajeIncremento = $objPasajero->darPorcentajeIncremento();
        $costoBaseViaje = $this->getCostoViaje();
        $costoBoleto = $costoBaseViaje * ($porcentajeIncremento / 100);
        $costoTotal = $costoBaseViaje + $costoBoleto;
        return $costoTotal;
    }



    /**
     * Concateno el listado de los pasajeros
     * @return lista
     */
    public function listadoPasajeros()
    {
        $col = $this->getColPasajero(); // no paso por parametro esto lo obtengo aca
        $enum = count($col);
        $listado = "";

        for ($i = 0; $i < $enum; $i++) {
            $pasajeros = $col[$i];
            $listado .= $pasajeros . "\n";
        }
        return $listado;
    }

    public function __toString()
    {
        $msj = "Codigo:  " . $this->getCodViaje() . "\n";
        $msj .= "--------\n";
        $msj .= "Destino: " . $this->getDestino() . "\n";
        $msj .= "--------\n";
        $msj .= "Capacidad máxima de Pasajeros: " . $this->getMaxPasajero() . "\n";
        $msj .= "--------\n";
        $msj .= "Responsable del viaje: " . $this->getObjResponsableViaje() . "\n";
        $msj .= "--------\n";
        $msj .= "Lista Pasajeros:" . $this->listadoPasajeros() . "\n";
        $msj .= "Costo total del viaje: " . $this->calcularCostoFinal() . "\n";
        return $msj;
    }
}
