<?php 
class Dict{
    private $MotEnArabe,$MotEnFrancais,$Signification,$Exemple,$Photo,$Owner;

    function __construct($MotEnArabe,$MotEnFrancais,$Signification,$Exemple,$Photo,$Owner){
        $this->MotEnArabe=$MotEnArabe;
        $this->MotEnFrancais=$MotEnFrancais;
        $this->Signification=$Signification;
        $this->Exemple=$Exemple;
        $this->Photo=$Photo;
        $this->Owner=$Owner;
    }

    function getMotEnArabe(){
        return $this->MotEnArabe;
    }
    function getMotEnFrancais(){
        return $this->MotEnFrancais;
    }
    function getSignification(){
        return $this->Signification;
    }
    function getExemple(){
        return $this->Exemple;
    }
    function getPhoto(){
        return $this->Photo;
    }
    function getOwner(){
        return $this->Owner;
    }

    function setMotEnArabe($MotEnArabe){
        $this->MotEnArabe=$MotEnArabe;
    }
    function setMotEnFrancais($MotEnFrancais){
        $this->MotEnFrancais=$MotEnFrancais;
    }
    function setSignification($Signification){
        $this->Signification=$Signification;
    }
    function setExemple($Exemple){
        $this->Exemple=$Exemple;
    }
    function setPhoto($Photo){
        $this->Photo=$Photo;
    }
    function setOwner($Owner){
        $this->Owner=$Owner;
    }

}
?>