<?php 
class User{
    private $UserName,$Email,$Password,$Photo;

    function __construct($UserName,$Email,$Password,$Photo){
        $this->UserName=$UserName;
        $this->Email=$Email;
        $this->Password=$Password;
        $this->Photo=$Photo;
    }

    function getUserName(){
        return $this->UserName;
    }
    function getEmail(){
        return $this->Email;
    }
    function getPassword(){
        return $this->Password;
    }
    function getPhoto(){
        return $this->Photo;
    }

    function setUserName($UserName){
        $this->UserName=$UserName;
    }
    function setEmail($Email){
        $this->Email=$Email;
    }
    function setPassword($Password){
        $this->Password=$Password;
    }
    function setPhoto($Photo){
        $this->Photo=$Photo;
    }
}
?>