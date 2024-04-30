<?php


/*En la clase Inmueble se registra la siguiente información: código de referencia, 
 el número de piso en el que se encuentra dentro del edificio, el tipo de uso  (comercial o departamento), costo mensual 
 y una referencia al inquilino si se encuentra alquilado.*/

class Inmueble
{

    private $codigoRef;
    private $piso;
    private $tipo;
    private $costoMensual;
    private $objInquilino;


    public function __construct($codigo, $piso, $tipo, $cosmen, $objInq)
    {
        $this->codigoRef = $codigo;
        $this->piso = $piso;
        $this->tipo = $tipo;
        $this->costoMensual = $cosmen;
        $this->objInquilino = $objInq;
    }

    public function getCodigo()
    {
        return  $this->codigoRef;
    }
    public function getPiso()
    {
        return $this->piso;
    }
    public function getTipo()
    {
        return  $this->tipo;
    }
    public function getCostoMensual()
    {
        return   $this->costoMensual;
    }
    public function getObjInquilino()
    {
        return   $this->objInquilino;
    }

    public function setCodigo($cod)
    {
        $this->codigoRef = $cod;
    }
    public function setPiso($piso)
    {
        $this->piso = $piso;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function setCostoMensual($cmens)
    {
        $this->costoMensual = $cmens;
    }
    public function setObjInquilino($objinq)
    {
        $this->objInquilino = $objinq;
    }

    public function __toString()
    {
        return "Codigo de Edificio: " . $this->getCodigo() . "\n" .
            "Piso: " . $this->getPiso() . "\n" .
            "Tipo: " . $this->getTipo() . "\n" .
            "Ocupado: " . $this->getCostoMensual() . "\n" .
            "Inquilino: " . $this->getObjInquilino() . "\n";
    }


    //METODOS AUXILIARES

 /*Implementar el método alquilar(obj) el cual recibe por parámetro la referencia al nuevo inquilino del inmueble. 
    Tener en cuenta que un inmueble sólo puede ser alquilado si no se encuentra alquilado en ese momento.
    Se debe retornar verdadero o falso según se haya podido o no alquilar el inmueble. */

    public function alquilar($obj)
    {
        $objInmueble = $this->getObjInquilino();
        $alquilado = false;

        if ($objInmueble == null) {
            $alquilado = true;
            $objInmueble->setObjInquilino($obj);
        } else {
            $alquilado = false;
        }


        return $alquilado;
    }

    /*Implementar el método estaDisponible el cual recibe como parámetro el tipo  
    de uso que se requiere y el monto máximo disponible para alquilar y determine si el
    inmueble está disponible o no. 
    Tener en cuenta que un inmueble sólo puede ser alquilado si no se encuentra alquilado en ese momento. 
    Ingrese una implementación posible para el método.*/


    public function estaDisponible($tipoUso, $montoMax)
    {
        $disponible = false;

      
            if ($this->getObjInquilino() == null && $this->getTipo() == $tipoUso
                && $this->getCostoMensual() <= $montoMax
            ) {
                $disponible = true;
            } else {
                $disponible = false;
            }
         
        return $disponible;
    }
}
