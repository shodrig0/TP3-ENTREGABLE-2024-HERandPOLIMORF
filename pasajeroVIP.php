<?php

class pasajeroVIP extends Pasajero
{

    // atributos
    private $numViajeroFrec;
    private $cantMillas;

    public function __construct($nombre, $apellido, $documento, $telefono, $numAsiento, $numTicket, $numViajeroFrec, $cantMillas)
    {
        parent::__construct($nombre, $apellido, $documento, $telefono, $numAsiento, $numTicket);
        $this->numViajeroFrec = $numViajeroFrec;
        $this->cantMillas = $cantMillas;
    }

    public function getNumViajeroFrencuente()
    {
        return $this->numViajeroFrec;
    }

    public function setViajeroFrecuente($numViajeroFrec)
    {
        $this->numViajeroFrec = $numViajeroFrec;
    }

    public function getCantMillas()
    {
        return $this->cantMillas;
    }

    public function setCantMillas($cantMillas)
    {
        $this->cantMillas = $cantMillas;
    }

    public function darPorcentajeIncremento()
    {
        $incrementoVIP = 35;

        if ($this->getCantMillas() > 300) {
            $incrementoVIP = 30;
        }

        return $incrementoVIP;
    }


    public function __toString()
    {
        $msj = "\n»»»»««««\n";
        $msj .= parent::__toString();
        $msj .= "Número de Viajero Frecuente: " . $this->getNumViajeroFrencuente() . "\n";
        $msj .= "Cantidad de millas: " . $this->getCantMillas() . "\n";

        return $msj;
    }
}
