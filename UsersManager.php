<?php 
include_once 'DataAccess.php';
include_once 'User.php';
class UsersManager{

        // 1 methode inscription : 

        public static function checkexixstance(User $user){
            $u=$user->getUserName();
            $e=$user->getEmail();

            $req="select * from users where UserName='$u' or mail='$e' ";
            $curseur1= DataAccess::selection($req);
            
            return $curseur1->rowCount();

        }

        public static function Inscrire(User $user){

            $u=$user->getUserName();
            $e=$user->getEmail();
            $p=$user->getPassword();
            $ph=$user->getPhoto();

            $r=self::checkexixstance($user);
            if($r==0){
                $req="insert into users(UserName,mail,Password,Photo) values('$u','$e','$p','$ph')";
                $nbr= DataAccess::miseajour($req);
            }
            return $r;

            
        }

        public static function Login($u,$p){
            $req="select * from users where UserName='$u' and Password='$p'";
       
            $curseur1= DataAccess::selection($req);
        
            $nb=   $curseur1->rowCount();
        
            return $nb;
        }


        public static function GetEmailByUsername($user){
            $req="select mail from users where UserName='$user' ";
            $curseur1= DataAccess::selection($req);
            $r="";
            while($row=$curseur1->fetch()){
                $r=$row[0];
            }
            $curseur1->closeCursor();
            return $r;
        }

        public static function GetPofilePictureByUsername($user){
            $req="select Photo from users where UserName='$user' ";
            $curseur1= DataAccess::selection($req);
            $r="";
            while($row=$curseur1->fetch()){
                $r=$row[0];
            }
            $curseur1->closeCursor();
            return $r;
        }

        public static function Modifier($olduser,$newuser,$pass,$newemail,$oldemail,$photo){
            $nbr=0;
            $r1=0;
            $r2=0;
            if($olduser!=$newuser){
                $curseur1= DataAccess::selection("select * from users where UserName='$newuser' ");
                if($curseur1->rowCount()!=0){
                    $r1=1;
                }
            }
            if($oldemail!=$newemail){
                $curseur1= DataAccess::selection("select * from users where mail='$newemail' ");
                if($curseur1->rowCount()!=0){
                    $r2=1;
                }
            }
            if($r1==0 && $r2==0){
                $req="update users set UserName='$newuser',mail='$newemail',Password='$pass',Photo='$photo' where UserName='$olduser' ";
                $nbr= DataAccess::miseajour($req);
            }
            return $nbr;

           
        }


}
?>