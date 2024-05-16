<?php

class Pasajero extends Persona
{
    private $documento;
    private $telefono;
    private $numAsiento;
    private $numTicket;

    public function __construct($nombre, $apellido, $documento, $telefono, $numAsiento, $numTicket)
    {
        parent::__construct($nombre, $apellido);
        $this->documento = $documento;
        $this->telefono = $telefono;
        $this->numAsiento = $numAsiento;
        $this->numTicket = $numTicket;
    }

    /**
     * get y set numDoc
     */
    public function getNumDoc()
    {
        return $this->documento;
    }

    public function setNumDoc($documento)
    {
        $this->documento = $documento;
    }

    /**
     * get y set telefono
     */
    public function getTel()
    {
        return $this->telefono;
    }

    public function setTel($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * get y set de numero Asiento
     */
    public function getNumAsiento()
    {
        return $this->numAsiento;
    }

    public function setNumAsiento($numAsiento)
    {
        $this->numAsiento = $numAsiento;
    }

    /**
     * get y set de numero Ticket
     */
    public function getNumTicket()
    {
        return $this->numTicket;
    }

    public function setNumTicket($numTicket)
    {
        $this->numTicket = $numTicket;
    }

    public function darPorcentajeIncremento()
    {
        $incremento = 10;

        return $incremento;
    }

    // retorno todo en la variable msj
    public function __toString()
    {
        $msj = "\n»»»»««««\n";
        $msj .= parent::__toString();
        $msj .= "DNI: " . $this->getNumDoc() . "\n";
        $msj .= "Teléfono: " . $this->getTel() . "\n";
        $msj .= "Asiento número: " . $this->getNumAsiento() . "\n";
        $msj .= "Ticket número: " . $this->getNumTicket() . "\n";

        return $msj;
    }
}
