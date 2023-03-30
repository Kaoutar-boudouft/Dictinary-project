<?php 
include_once 'DictManager.php';
if(isset($_POST['filter'])){
    $result=DictManager::showall($_POST['filter']);
    $f=$result->columnCount()-2;
    if($result->rowCount()==0){
     echo("<h6>Votre dictionnaire est vide!</h6>");        
    }
    else{
      echo("<div class='table-responsive'>");
      echo("<table class='table' style='background-color:black;color:white'>");
      echo("<thead>");
      echo("<th style='width:200px;border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'>Le mot en arabe</th>");
      echo("<th style='border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'>Le mot en francais</th>");
      echo("<th style='border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'>La signification</th>");
      echo("<th style='border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'>Exemple</th>");
      echo("<th scope='col' style='border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'>image</th>");
      echo("<th scope='col' style='border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'>Operation</th>");

      echo("</tr>");
      echo("</thead>");
      echo("<tbody>");
      while($row=$result->fetch()){
        echo("<tr>");
        for($j=1;$j<$f;$j++){
          echo("<td style='width:200px;border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'>");
          echo($row[$j]);
          echo("</td>");
        }
        echo("<td style='border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'><img src='$row[$f]' width='150px' height='150px'></td>");
        echo("<td style='border:1px solid rgba(149, 64, 219, 0.91);padding:8px;text-align:center'><br><a id='$row[0]' class='supp' style='color:white;background-color:rgba(149, 64, 219, 0.91);padding:8px;border-radius:8px;text-decoration:none;display:block;width:100px'>Supprimer</a><br><a href='Modifier.php?mfind=$row[0]' style='color:white;display:block;;width:100px;background-color:rgba(149, 64, 219, 0.91);padding:8px;border-radius:8px;text-decoration:none'>Modifier</a></td>");
        echo("</tr>");

      }
      $result->closeCursor(); 
      echo("</tbody>");
      echo("</table>");
      echo("</div>");

      
    }
    
  }
  ?>
  <script>
    $(function(){
      $('.supp').click(function(e){
        let v=  e.target.id;
        $.ajax({
            type:"POST",
            url:"removeword.php",
            data:'id='+v
          }).done(function(res){
            $('#result').html(res);
          })
      })
    })
  </script>
  <?php
  
?>