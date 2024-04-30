<?php

/*Una empresa inmobiliaria requiere una aplicación que le permita administrar los departamentos o locales que tiene 
para alquiler en los diferentes edificios construidos en la zona. 

De cada EDIFICIO se registra la siguiente información: dirección, la persona encargada del edificio y cada uno de los 
inmuebles que lo conforman. */




class Edificio
{

    private $direccion;
    private $encargado;
    private $colInmuebles;

    public function __construct($dir, $encargado, $colInmueble)
    {
        $this->direccion = $dir;
        $this->encargado = $encargado;
        $this->colInmuebles = $colInmueble;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getEncargado()
    {
        return $this->encargado;
    }
    public function getColInmueble()
    {
        return $this->colInmuebles;
    }

    public function setDireccion($dir)
    {
        $this->direccion = $dir;
    }
    public function setEncargado($encargado)
    {
        $this->encargado = $encargado;
    }
    public function setColInmueble($colinm)
    {
        $this->colInmuebles = $colinm;
    }

    public function __toString()
    {
        return "Direccion: " . $this->getDireccion() . "\n" .
            "Encargado: " . $this->getEncargado() . "\n" .
            "Inmuebles: " . $this->retornarCadena($this->getColInmueble()) . "\n";
    }


    //METODOS AUXILIARES


    //funcion general que me retornara una cadena de cada coleccion que tenga en el toString

    public function retornarCadena($coleccion)
    {
        $cadena = "";
        foreach ($coleccion as $unElemento) {
            $cadena = $cadena . " " . $unElemento . "\n";
        }
        return $cadena;
    }

    /*Implementar el método darInmueblesDisponibles que recibe por parámetro 
    el tipo de uso del inmueble y el costo mensual máximo que se puede pagar y retorna una colección 
    e todos los departamentos del tipo de uso  recibido (tipoUso) que se encuentran disponibles para 
    ser alquilados y cuyo costo mensual no supera el valor recibido en el parámetro costoMaximo.*/

    public function darInmueblesDisponibles($tipouso, $costoMaximo)
    {

        $inmueblesDisponibles = [];
        $coleccionInmuebles = $this->getColInmueble();

        for ($i = 0; $i < count($coleccionInmuebles); $i++) {

            $objInmueble = $coleccionInmuebles[$i];

            if ($objInmueble->estaDisponible($tipouso, $costoMaximo) == true) {
                array_push($inmueblesDisponibles, $objInmueble);
            }
        }
        return $inmueblesDisponibles;
    }

    /*Implementar el método buscarInmueble que recibe por parámetro un objeto inmueble y retorna el índice de la 
    colección donde se encuentra almacenado. Si el objeto no existe en la colección se debe retornar el valor-1*/

    public function buscarInmueble($objinmueble)
    {

        $encontrado = false;
        $colInmuebles = $this->getColInmueble();
        $codigo = $objinmueble->getCodigo();

        $i = 0;
        while ($i < count($colInmuebles) && !$encontrado) {
            $uninmueble = $colInmuebles[$i];
            if ($uninmueble->getCodigo() == $codigo) {
                $encontrado = true;
            }
            $i++;
        }
        if ($encontrado == true) {
            return [$i];
        } else {
            return -1;
        }
    }

    /*Implementar el método registrarAlquilerInmueble que recibe por parámetro el tipo de uso que se requiere 
    para el inmueble (tipoUso) , el monto máximo (montoMaximo) a pagar por mes y la referencia a la persona que  
    desea alquilar (objPersona) el inmueble. 
    Tener en cuenta que solo se va a poder realizar el alquiler de dicho inmueble si se verifica la política 
    de alquiler de la empresa.  Por política de la empresa, los inmuebles de un  edificio se deben ir ocupando 
    por piso y por tipo. Es decir, hasta que todos los inmuebles de un piso y de un tipo no se encuentren ocupados,
    no es posible alquilar un inmueble de un piso superior.
    El método debe retornar verdadero en caso de poder registrar el alquiler o falso en caso contrario. 
    Recordar actualizar las estructuras correspondientes*/


    public function registrarAlquilerInmueble($tipoUso, $montoMaximo, $objPersona)
    {
        //debo saber qué inmuebles estan disponibles, para eso llamo al metodo "darInmueblesDisponibles()"
        $coleccioninmueblesDisponibles = $this->darInmueblesDisponibles($tipoUso, $montoMaximo);

        /* De todos los disponibles se recorre la coleccion para detectar los pisos mas bajos disponibles y
         CUMPLIR CON LA POLITICA DE LA EMPRESA. Se arma una nueva coleccion*/
        $numpisoencontrado = 200;
        $coleccionmenorpiso = [];
        $registrar = false;

        for ($i = 0; $i < count($coleccioninmueblesDisponibles); $i++) {
            $inmueble = $coleccioninmueblesDisponibles[$i];
            $numpiso = $inmueble->getPiso();
            if ($numpiso <= $numpisoencontrado) {
                $numpisoencontrado = $numpiso;
                array_push($coleccionmenorpiso, $inmueble);
            }
        }

        //RECORRO LA NUEVA COLECCION para obtener aquellos que cumplen con el uso y con el monto...
        for ($i = 0; $i < count($coleccionmenorpiso); $i++) {

            $inmueblespisoInferior = $coleccionmenorpiso[$i];
            $uso = $inmueblespisoInferior->getTipo();
            $presupuesto = $inmueblespisoInferior->getCostoMensual();

            if ($uso == $tipoUso && $montoMaximo <= $presupuesto && $objPersona->alquilar($objPersona) == true) {

                $registrar = true;
            } else {
                $registrar = false;
            }
        }
        return $registrar;
    }
}
