<?php
include_once 'DictManager.php';
$i=$_POST['id'];
$r=DictManager::supprimer($i);
    if($r==0){
      echo("error");
    }
    else{
      ?>
      <script>
        const y=document.getElementById("all");
        y.click();
      </script>
      <?php
      echo("la suppression a ete bien effectue!");
    }
?>