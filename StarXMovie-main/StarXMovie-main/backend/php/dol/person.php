<?php

require_once('admin.php');

class Person extends Admin implements JsonSerializable{
    private $PNombre;
    private $SNombre;
    private $PApellido;
    private $SApellido;
    private $NUsuario;
    private $Pass;
    private $Mail;
    private $IdPregunta;
    private $Respuesta;
    private $FNacimiento;
    private $FPerfil;
    private $CFavorita;

    // Setter methods
    public function setPNombre($PNombre) {
        $this->PNombre = $PNombre;
    }

    public function setSNombre($SNombre) {
        $this->SNombre = $SNombre;
    }

    public function setPApellido($PApellido) {
        $this->PApellido = $PApellido;
    }

    public function setSApellido($SApellido) {
        $this->SApellido = $SApellido;
    }

    public function setNUsuario($NUsuario) {
        $this->NUsuario = $NUsuario;
    }

    public function setPass($Pass) {
        $this->Pass = password_hash($Pass,PASSWORD_DEFAULT);
    }

    public function setMail($Mail) {
        $this->Mail = $Mail;
    }

    public function setIdPregunta($IdPregunta) {
        $this->IdPregunta = $IdPregunta;
    }

    public function setRespuesta($Respuesta) {
        $this->Respuesta = $Respuesta;
    }

    public function setFNacimiento($FNacimiento){
        $this->FNacimiento=$FNacimiento;
    }

    public function setFPerfil($FPerfil){
        $this->FPerfil = $FPerfil;
    }

    public function setCFavorita($CFavorita) {
        $this->CFavorita = $CFavorita;
    }

    // Getter methods

    public function getPNombre() {
        return $this->PNombre;
    }

    public function getSNombre() {
        return $this->SNombre;
    }

    public function getPApellido() {
        return $this->PApellido;
    }

    public function getSApellido() {
        return $this->SApellido;
    }

    public function getNUsuario() {
        return $this->NUsuario;
    }

    public function getPass() {
        return $this->Pass;
    }

    public function getMail() {
        return $this->Mail;
    }

    public function getIdPregunta() {
        return $this->IdPregunta;
    }

    public function getRespuesta() {
        return $this->Respuesta;
    }

    public function getFNacimiento() {
        return $this->FNacimiento;
    }

    public function getFPerfil() {
        return $this->FPerfil;
    }

    public function getCFavorita() {
        return $this->CFavorita;
    }

    //JSON
    public function jsonSerialize() {
        return get_object_vars($this);
    }

}


?>