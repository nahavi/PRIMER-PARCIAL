<?php
//En la clase Persona se registra el  tipo y número de documento, nombre, apellido y teléfono de contacto.


class Personaparcial{

private $apellido;
private $nombre;
private $tipodoc;
private $numdoc;
private $telefono;

public function __construct($adress, $name, $tipo, $num, $tel)
{
    $this->apellido=$adress;
    $this->nombre=$name;
    $this->tipodoc=$tipo;
    $this->numdoc=$num;
    $this->telefono=$tel;
}

public function getApellido(){
    return $this->apellido;
}
public function getNombre(){
    return $this->nombre;
}
public function getTipoDoc(){
    return $this->tipodoc;
}
public function getNumDoc(){
    return $this->numdoc;
}
public function getTelefono(){
    return $this->telefono;
}

public function setApellido($ape){
    $this->apellido=$ape;
}
public function setNombre($nom){
    $this->nombre=$nom;
}
public function setTipoDoc($tipo){
    $this->tipodoc=$tipo;
}
public function setNumDoc($num){
    $this->numdoc=$num;
}
public function setTelefono($tel){
    $this->telefono=$tel;
}

public function __toString()
{
    return "Apellido: " .$this->getApellido() ."\n".
    "Nombre: " .$this->getNombre() ."\n".
    "Tipo Documento: " .$this->getTipoDoc() ."\n".
    "Numero de Documento: " .$this->getNumDoc() ."\n".
    "Telefono: " . $this->getTelefono(). "\n";
}



}