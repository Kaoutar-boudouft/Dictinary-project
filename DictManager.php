<?php 
include_once 'DataAccess.php';
include_once 'Dict.php';
class DictManager{

    public static function checkexixstance(Dict $d){
        $ma=$d->getMotEnArabe();
        $mf=$d->getMotEnFrancais();

        $req="select * from dicts where MotEnArabe='$ma' and MotEnFrancais='$mf' ";
        $curseur1= DataAccess::selection($req);
        
        return $curseur1->rowCount();

    }

    public static function addmot(Dict $d){
        $ma=$d->getMotEnArabe();
        $mf=$d->getMotEnFrancais();
        $si=$d->getSignification();
        $ex=$d->getExemple();
        $ph=$d->getPhoto();
        $ow=$d->getOwner();

        $r=self::checkexixstance($d);

        if($r==0){
            $req="insert into dicts(MotEnArabe,MotEnFrancais,Signification,Exemple,Photo,Owner) values('$ma','$mf','$si','$ex','$ph','$ow')";
            $nbr= DataAccess::miseajour($req);
        }


        return $r;
    }

    public static function showall($user){
        $req="select * from dicts where Owner='$user' ";

        $curseur1= DataAccess::selection($req);
        return $curseur1;

    }

    public static function search($word,$user){
        if(preg_match("/[a-z]/i", $word)){
            $req="select * from dicts where Owner='$user' and MotEnFrancais='$word' ";
            $curseur1= DataAccess::selection($req);
            if($curseur1->rowCount()==0){
                $req="select * from dicts where Owner='$user' and MotEnFrancais like'$word%' ";
                $curseur1= DataAccess::selection($req);
            }
            return $curseur1;
        }
        elseif(preg_match("/[0-9]/i", $word)){
            $result="vous n'avez pas le droit de saisir des nombres :)!";
            return $result;
        }
        elseif($word==""){
            $result="Vous Devez Inserez qq chose !";
            return $result;
        }
        else{
            $req="select * from dicts where Owner='$user' and MotEnArabe='$word' ";
            $curseur1= DataAccess::selection($req);
            if($curseur1->rowCount()==0){
                $req="select * from dicts where Owner='$user' and MotEnArabe like '$word%' ";
            $curseur1= DataAccess::selection($req);
            }
            return $curseur1;
        }
    }


    public static function GetLastId(){
        $req="select Id from dicts order by Id desc limit 1";
        $curseur1= DataAccess::selection($req);
        $LI="";
        while($row=$curseur1->fetch()){
            $LI=$row[0];
        }
        $curseur1->closeCursor();
        return $LI;
    }



    public static function GetIdByWords($a,$f,$owner){
        $req="select Id from dicts where Owner='$owner' and MotEnArabe='$a' and MotEnFrancais='$f' ";
        $curseur1= DataAccess::selection($req);
        $LI="";
        while($row=$curseur1->fetch()){
            $LI=$row[0];
        }
        $curseur1->closeCursor();
        return $LI;
    }

    public static function GetRowById($i){
        $req="select * from dicts where Id='$i' ";
        $curseur1= DataAccess::selection($req);
        return $curseur1;

    }

    public static function GetImageById($i){
        $req="select Photo from dicts where Id='$i' ";
        $curseur1= DataAccess::selection($req);
        $sp="";
        while($row=$curseur1->fetch()){
            $sp=$row[0];
        }
        $curseur1->closeCursor();
        return $sp;

    }

    public static function supprimer($i){
        $nbr=0;
        $curs=DataAccess::selection("select * from dicts where Id='$i'");
        if($curs->rowCount()!=0){
        $sp=self::GetImageById($i);
        unlink($sp);
        $req="delete from dicts where Id='$i' ";
        $nbr= DataAccess::miseajour($req);

        $req2="select * from dicts";
        $curs=DataAccess::selection($req2);

        if($curs->rowCount()==0){
            $req3="truncate dicts";
            $nbr2= DataAccess::miseajour($req3);
        }
    }
        return $nbr;
    }

    public static function modifier(Dict $d,$i){
       
        
        $si=$d->getSignification();
        $ex=$d->getExemple();
        $ph=$d->getPhoto();


        $req="update dicts set  Signification='$si',Exemple='$ex',Photo='$ph' where Id='$i' ";
        $nbr= DataAccess::miseajour($req);
        return $nbr;

    }

    public static function GetHistoires(){
        $req="select * from histoire";
        $curseur1= DataAccess::selection($req);
        return $curseur1;
    }

    public static function GetHistoiresByType($type){
        $req="select * from histoire where Type='$type' ";
        $curseur1= DataAccess::selection($req);
        return $curseur1;
    }

    public static function GetAchats($user){
        $req="select * from achats where usern='$user' ";
        $curs=DataAccess::selection($req);
        $r=array();
        if($curs->rowCount()!=0){
            while($row=$curs->fetch()){
                $r[]=$row[2];
            }
            $curs->closeCursor();

        }
        return $r;
    }
}

?>