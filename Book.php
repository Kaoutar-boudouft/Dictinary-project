<?php 
include_once 'DataAccess.php';
class Book{
    private $histid,$userid;

    function __construct($histid,$userid){
        $this->histid=$histid;
        $this->userid=$userid;
    }

    function setHistId($histid){
        $this->histid=$histid;
    }

    function setUserId($userid){
        $this->userid=$userid;
    }

    function getHistId(){
        return $this->histid;
    }

    function getUserId(){
        return $this->userid;
    }

    public static function gethistoirebyid($id){
        $req="select * from histoire where id='$id'";
        $curs=DataAccess::selection($req);
        return $curs;
        
    }

}
?>