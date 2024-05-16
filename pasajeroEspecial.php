<?php

class PasajeroEspecial extends Pasajero
{
    // aitrubtos
    private $reqSillaRuedas;
    private $reqAsist;
    private $reqComidaEspecial;

    public function __construct($nombre, $apellido, $documento, $telefono, $numAsiento, $numTicket, $reqSillaRuedas, $reqAsist, $reqComidaEspecial)
    {
        parent::__construct($nombre, $apellido, $documento, $telefono, $numAsiento, $numTicket);
        $this->reqSillaRuedas = $reqSillaRuedas;
        $this->reqAsist = $reqAsist;
        $this->reqComidaEspecial = $reqComidaEspecial;
    }

    public function getReqSillaRuedas()
    {
        return $this->reqSillaRuedas;
    }

    public function setReqSillaRuedas($reqSillaRuedas)
    {
        $this->reqSillaRuedas = $reqSillaRuedas;
    }

    public function getReqAsist()
    {
        return $this->reqAsist;
    }

    public function setReqAsist($reqAsist)
    {
        $this->reqAsist = $reqAsist;
    }

    public function getReqComidaEspecial()
    {
        return $this->reqComidaEspecial;
    }

    public function setReqComidaEspecial($reqComidaEspecial)
    {
        $this->reqComidaEspecial = $reqComidaEspecial;
    }

    public function darPorcentajeIncremento()
    {
        return $this->calcularIncremento();
    }

    private function calcularIncremento()
    {

        $incremento = 0;

        if ($this->getReqSillaRuedas() && $this->getReqAsist() && $this->getReqComidaEspecial()) {
            $incremento = 30;
        } elseif ($this->getReqSillaRuedas() || $this->getReqAsist() || $this->getReqComidaEspecial()) {
            $incremento = 15;
        }

        return $incremento;
    }

    public function __toString()
    {
        $msj = "\n»»»»««««\n";
        $msj .= parent::__toString();
        $msj .= "Requiere silla de ruedas: " . $this->getReqSillaRuedas() . "\n";
        $msj .= "Requiere asistencia: " . $this->getReqAsist() . "\n";
        $msj .= "Requiere comida especial: " . $this->getReqComidaEspecial() . "\n";

        return $msj;
    }
}
