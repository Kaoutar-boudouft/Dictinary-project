<?php
include_once 'DictManager.php';
include_once 'Panier.php';
session_start();
$panier=$_SESSION['panier'];
$p=$panier->getTableau();
$x=$_SESSION['user']; 

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $panier->supprimerdupanier($id);
    $p=$panier->getTableau();

    ?>
    <script>
              document.getElementById('number').innerHTML="My Card "+"<?php echo(count($p)); ?>";
    </script>
    <table width="100%" border="1px">
    <tr>
      <th style="text-align:center;border:1px solid black">Titre</th>
      <th style="text-align:center;border:1px solid black">Couvre</th>
      <th style="text-align:center;border:1px solid black">Prix</th>
      <th style="text-align:center;border:1px solid black">Operation</th>
    </tr>
<?php
$t=0;
foreach($p as $book){
$idb=$book->getHistId();
$curs=Book::gethistoirebyid($idb);
while($row=$curs->fetch()){
$t=$t+$row[7];
?>
<tr>
<td style="width:40%;text-align:center;border:1px solid black"><?php echo($row[1]) ;?></td>
<td style="width:30%;text-align:center;border:1px solid black"><img src="<?php echo($row[2]) ;?>" width="150px" height="100px" ></td>
<td style="width:30%;text-align:center;border:1px solid black"><?php echo($row[7]) ;?>DH</td>
<td style="width:30%;text-align:center;border:1px solid black"><input type="button" id="<?php echo($row[0]) ;?>" class="supp" value="supprimer"></td>
</tr>

<?php
}

}
  }
  ?>
  <br>
          <?php echo("<h4 align='center'>Le Total Est : $t DH</h4>"); ?>
  <?php
  ?>
  <script>
    $(function(){
      $('.supp').click(function(e){
         let v=  e.target.id;
          $.ajax({
            type:"POST",
            url:"removefromcart.php",
            data:'id='+v
          }).done(function(res){
            $('#c').html(res);
          })
       })
    })
     
  </script>
  <?php
?>
