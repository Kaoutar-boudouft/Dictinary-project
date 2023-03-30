<?php
include_once 'DataAccess.php';
include_once 'Panier.php';
session_start();
$x=$_SESSION['user']; 
  $password=$_SESSION['pass'];
  $panier=$_SESSION['panier'];
  $p=$panier->getTableau();

    $numero=$_POST['numero'];
    $doneur=$_POST['doneur'];
    $annee=$_POST['annee'];
    $mois=$_POST['mois'];
    $crypto=$_POST['crypto'];

    $req="select * from cartebancaire";
    $curs1=DataAccess::selection($req);

    $r=0;
    while($row=$curs1->fetch()){
        if($row[0]==$numero && $row[1]==$doneur && $row[2]==$annee && $row[3]==$mois && $row[4]==$crypto){
            $r=1;
            for($i=0;$i<count($p);$i++){
                $book=$p[$i];
                $id=$book->getHistId();
                $req="insert into achats(usern,histid) values('$x','$id') ";
                $r=DataAccess::miseajour($req);
            }
            $req="delete from panier where usern='$x' ";
            $r=DataAccess::miseajour($req);
            $panier=new Panier();
            $_SESSION['panier']=$panier;
            $r=1;
        }
    }
    $curs1->closeCursor();
    if($r!=0){
        ?>
        <script>
            document.getElementById('fer').click();
            document.getElementById('c').innerHTML="<h6 align='center' style='color:green'>Loperation a ete bien effectuer!</h6>";
            document.getElementById('next').style.display="none";
            document.getElementById('cance').style.display="none";
            setTimeout(function(){ window.location="histoire.php" }, 500);
            
    </script>
        <?php
    }
    else{
        echo("<h6 align='center' style='color:red'>Verifier vos donnees svp</h6>");

    }
?>