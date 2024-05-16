<?php

class ResponsableV extends Persona
{
    private $numEmpleado;
    private $numLicencia;

    public function __construct($nombre, $apellido, $numeroDeEmpleado, $numeroDeLicencia)
    {
        parent::__construct($nombre, $apellido);
        $this->numEmpleado = $numeroDeEmpleado;
        $this->numLicencia = $numeroDeLicencia;
    }

    public function getNumLicencia()
    {
        return $this->numLicencia;
    }

    public function setNumLicencia($numeroDeLicencia)
    {
        $this->numLicencia = $numeroDeLicencia;
    }

    public function getNumEmpleado()
    {
        return $this->numEmpleado;
    }

    public function setNumEmpleado($numeroDeEmpleado)
    {
        $this->numEmpleado = $numeroDeEmpleado;
    }

    public function __toString()
    {
        $msj = parent::__toString();
        $msj .= "\nNúmero de Empleado: " . $this->getNumEmpleado() . "\n";
        $msj .= "Numero de Licencia: " . $this->getNumLicencia() . "\n";

        return $msj;
    }
}
