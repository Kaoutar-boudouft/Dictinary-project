<?php 
include_once 'DictManager.php';
include_once 'Panier.php';
session_start();
$panier=$_SESSION['panier'];
$p=$panier->getTableau();
$t=$_POST['filter'];
$x=$_SESSION['user']; 

$achats=DictManager::GetAchats($x);
if($t=="Tout"){
  $response=DictManager::GetHistoires();
  if($response->rowCount()!=0){
    $i=0;
    while($row=$response->fetch()){
      if($i==0){
        echo("<br>");
        echo("<div class='row' >");
      }
      if($row[6]=="Gratuit" || in_array($row[0], $achats)){
        ?>
      <div class="col-lg-3 col-md-6">
      <div class="hist" >
        <div class="pic"><img src="<?=$row[2];?>" class="img-fluid" alt=""></div>
        <div class="info">
          <h4><?php echo("$row[1]");?></h4>
          <span>
          <input type="button" value="Voir Mainteneant !" onclick="voir('<?=$row[3];?>','<?=$row[1];?>','<?=$row[5];?>','<?=$row[4];?>')" ></span>
        </div>
      </div>
    </div>
      <?php
      }
      if($row[6]=="Premium" && !in_array($row[0], $achats)){
        ?>
      <div class="col-lg-3 col-md-6">
        <form >
      <div class="hist" >
        <div class="pic"><img src="<?=$row[2];?>" class="img-fluid" alt=""></div>
        <div class="info">
          <h4><?php echo("$row[1]");?></h4>
          <h6 style="color:rgba(149, 64, 219, 0.91);font-weight:bold"><?php echo("$row[7]");?>DH</h6>
          <span>
            <?php
            $r=0;
            foreach($p as $book){
              $idh=$book->getHistId();
              if($idh==$row[0]){
                $r=1;
              }
            }
            if($r==0){
              ?>
                <input type="button" style="background-color:black;" class="add" id="a<?=$row[0];?>" name="add" value="Ajouter au panier !" >
                <input type="text" class="id" name="id" value="<?=$row[0];?>" hidden="hidden"></span>
              <?php
            }
            else{
              ?>
              <h6 style="color:green">L'histoire a ete ajoute au panier!</h6>
              <?php
            }
            
            ?>
                             <div id="done"></div>

           
        </div>
      </div>
      </form>
    </div>
      <?php
      }
      
      $i++;
      if($i==4){
        echo("</div>");
        $i=0;
      }
    }
    $response->closeCursor();
  }
        
}
if($t=="Mes Histoires"){
  $response=DictManager::GetHistoires();
  $i=0;
 while($row=$response->fetch()){
  if($i==0){
    echo("<br>");
    echo("<div class='row' >");
  }
   if(in_array($row[0], $achats)){
    ?>
    <div class="col-lg-3 col-md-6">
    <div class="hist" >
      <div class="pic"><img src="<?=$row[2];?>" class="img-fluid" alt=""></div>
      <div class="info">
        <h4><?php echo("$row[1]");?></h4>
        <span>
        <input type="button" value="Voir Mainteneant !" onclick="voir('<?=$row[3];?>','<?=$row[1];?>','<?=$row[5];?>','<?=$row[4];?>')" ></span>
      </div>
    </div>
  </div>
  <?php
      }
      
      $i++;
      if($i==4){
        echo("</div>");
        $i=0;
      }
    }
    $response->closeCursor();
   }
else{
    $response=DictManager::GetHistoiresByType($t);
        if($response->rowCount()!=0){
            $i=0;
          while($row=$response->fetch()){
            if($i==0){
              echo("<br>");
              echo("<div class='row' >");
            }
            if($row[6]=="Gratuit" || in_array($row[0], $achats)){
              ?>
            <div class="col-lg-3 col-md-6">
            <div class="hist" >
              <div class="pic"><img src="<?=$row[2];?>" class="img-fluid" alt=""></div>
              <div class="info">
                <h4><?php echo("$row[1]");?></h4>
                <span>
                <input type="button" value="Voir Mainteneant !" onclick="voir('<?=$row[3];?>','<?=$row[1];?>','<?=$row[5];?>','<?=$row[4];?>')" ></span>
              </div>
            </div>
          </div>
            <?php
            }
            if($row[6]=="Premium" && !in_array($row[0], $achats)){
              ?>
            <div class="col-lg-3 col-md-6">
              <form>
            <div class="hist" >
              <div class="pic"><img src="<?=$row[2];?>" class="img-fluid" alt=""></div>
              <div class="info">
                <h4><?php echo("$row[1]");?></h4>
                <h6 style="color:rgba(149, 64, 219, 0.91);font-weight:bold"><?php echo("$row[7]");?>DH</h6>
                <span>
                  <?php
                  $r=0;
                  foreach($p as $book){
                    $idh=$book->getHistId();
                    if($idh==$row[0]){
                      $r=1;
                    }
                  }
                  if($r==0){
                    ?>
                <input type="button" style="background-color:black;" class="add" id="a<?=$row[0];?>" name="add" value="Ajouter au panier !" >
                <input type="text" class="id" name="id" value="<?=$row[0];?>" hidden="hidden"></span>
                    <?php
                  }
                  else{
                    ?>
                    <h6 style="color:green">L'histoire a ete ajoute au panier!</h6>
                    <?php
                  }
                  ?>
                                  <div id="done"></div>

              </div>
            </div>
            </form>
          </div>
            <?php
            }
            
            $i++;
            if($i==4){
              echo("</div>");
              $i=0;
            }
          }
          $response->closeCursor();
        }
}
?>
<script>
$(function(){
  $('#type').change(function(){
    var t=$('#type').val();
    $.ajax({
      type:"POST",
      url:"booksfilter.php",
      data:'filter='+t
    }).done(function(res){
      $('#result').html(res);
    })
  })

  $('.add').click(function(e){
    let v=  e.target.value;
    e.target.value="Supprimer du panier !";
    e.target.style.backgroundColor="gray";
    let x=$(this).next('input').val();
    $('#a'+x).hide();
    document.getElementById("done").innerHTML="<h6 style='color:green'>Lhistoire a ete ajoute au panier!</h6>";
    $.ajax({
      type:"POST",
      url:"addtocart.php",
      data:'id='+x
    }).done(function(res){
      $('#c').html(res);
    })

 })

/* $('.supp').click(function(e){
    let v=  e.target.value;
    e.target.value="Ajouter au panier !";
    e.target.style.backgroundColor="rgba(149, 64, 219, 0.91)";
    let x=$(this).prev('input').val();
    $('#s'+x).hide();
    $.ajax({
      type:"POST",
      url:"removefromcart.php",
      data:'id='+x
    }).done(function(res){
      $('#c').html(res);
    })
 })
*/
  
  
      })
</script>
<?php
?>