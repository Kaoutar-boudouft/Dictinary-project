<?php
include_once 'Book.php';
include_once 'DataAccess.php';
class Panier{
   private $tbooks;

   function __construct(){
       $this->tbooks=[];
   }

   function getTableau(){
    return $this->tbooks;
   }

   function ajouterpanier(Book $achat)
    {
        $this->tbooks[]=$achat;
    }

    function supprimerdupanier($id)
    {
        for ($i=0;$i<count($this->tbooks) ;$i++)
            {
            $achat=$this->tbooks[$i];
            $iditem=$achat->getHistId();
              if($iditem==$id){
                  unset($this->tbooks[$i]);
                  $this->tbooks=array_values($this->tbooks);
              }
            }
    }

    function exporterPanier($user){
            $req="delete from panier where usern='$user' ";
            $r=DataAccess::miseajour($req);
        for ($i=0;$i<count($this->tbooks) ;$i++)
            {
            $achat=$this->tbooks[$i];
            $iditem=$achat->getHistId();
            $req="insert into panier(histid,usern) values('$iditem','$user')";
            $r=DataAccess::miseajour($req);
            }
    }

    function importerPanier($user){
        $req="select * from panier where usern='$user' ";
        $curs=DataAccess::selection($req);
        while($row=$curs->fetch()){
            $b=new Book($row[2],$row[1]);
            $this->tbooks[]=$b;
        }

    }

}
?>