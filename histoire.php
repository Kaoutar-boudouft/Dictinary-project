<?php
include_once 'Panier.php';
session_start();
include_once 'UsersManager.php';
if(!empty($_SESSION['user'])){
  $x=$_SESSION['user']; 
  $password=$_SESSION['pass'];
  $panier=$_SESSION['panier'];
  $p=$panier->getTableau();

  $email=UsersManager::GetEmailByUsername($x);
$profilepicture=UsersManager::GetPofilePictureByUsername($x);
$n=15;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}
}
else{
  header("location:accueil.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/stylehistoire.css" rel="stylesheet">
    <title>ADMIN_AREA</title>
</head>
<style>
    .form-control:focus {
        border-color: #ff80ff;
        box-shadow: 0px 1px 1px rgba(149, 64, 219, 0.91) inset, 0px 0px 8px rgba(255, 100, 255, 0.5);
    }
</style>
<script>
  function verifiermodifier(){
                var ok=true;
                let x=document.getElementById('confir').value;
                let y=document.getElementById('config').innerHTML;
                if(x!=y)
                {
                    document.getElementById("remarque").innerHTML="<h6 style='color:red;font-size:9pt'>le code est incorrect!</h6>";
                    ok=false;
                }
                return ok;
            }
          

         
    
</script>
<body>
    <header id="header" style="background-color:black" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">
    
          <div class="logo">
            <a href="Add.php"><img src="./assets/img/logo2.png"></a><span style="color: white;font-weight: bold;cursor: pointer;">OURBOOK</span>
          </div>
    
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="#head">Accueil</a></li>
              <li><a class="nav-link scrollto" href="./add.php">Ajouter des mots</a></li>
              <li><a class="nav-link scrollto" href="./rechercher.php">Rechercher par mots</a></li>
              <li><a class="nav-link scrollto" href="./histoire.php">Bibliotheque</a></li>
              <li><div class="dropdown">
              <a class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php echo("$x"); ?>
</a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             <img src="<?=$profilepicture;?>"  width="50px" height="50px" style="margin-left:50px;border-radius:100%;border:3px solid purple">
             <a class="dropdown-item" style="color:black" href=""  data-toggle="modal" data-target="#edit">Parametres</a>
             <a class="dropdown-item" style="color:black" href="" id="number" data-toggle="modal" data-target="#acheter">MyCarte <?php echo(count($p)); ?></a>
             <a class="dropdown-item" style="color:black" href="logout.php">Deconnecter</a>
            </div>
            </div>
              </li>       </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </header><!-- End Header -->
      <br>
      <br>
      <br>
      <br>
      <!-- ======= histoire Section ======= -->
    <section id="histoire" class="histoire">
      <?php
    /*
    */
    ?>
      <div class="container">
        <br>
        <br>
        <br>
        <br>
        <div class="section-title" data-aos="fade-up">
          <h2>Bibliotheque</h2>
          <select id="type">
            <option value="Tout">Tout</option>
            <option value="Gratuit">Gratuit</option>
            <option value="Premium">Premium</option>
            <option value="Mes Histoires">Mes Histoires</option>
          </select>
        </div>
        <div  id="result" style="height:310px">
        <?php 
        include_once 'DictManager.php';
        $response=DictManager::GetHistoires();
        $achats=DictManager::GetAchats($x);
        if($response->rowCount()!=0){
          $i=0;
          while($row=$response->fetch()){
            if($i==0){
              echo("<br>");
              echo("<div class='row' data-aos='fade-left'>");
            }
            if($row[6]=="Gratuit" || in_array($row[0], $achats)){
              ?>
            <div class="col-lg-3 col-md-6">
            <div class="hist" data-aos="zoom-in" data-aos-delay="100">
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
              <form action="histoire.php#histoire" method="POST">
            <div class="hist" data-aos="zoom-in" data-aos-delay="100">
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
        
        ?>
        </div>
        </div>
        <div id="cc"></div>

    </section><!-- End  Section -->
    
  <script>

function  voir(a,b,c,d){
  document.getElementById("histfrancais").style.display="";
        document.getElementById("histarab").style.display="";

        document.getElementById("histfrancais").innerText=a;
        
        document.getElementById("titre").innerText=b;
        document.getElementById("line").style.display="";

        document.getElementById("histarab").innerText=c;
        document.getElementById("aud").innerHTML="<audio controls style='width:50%;margin:auto;'><source src='"+d+"' type='audio/mpeg'></audio>";
}
  </script>
      <br>
    <br>
    <div>
      <h3  id="titre" align="center" style="color:black;letter-spacing:4px;"></h3>
      <hr id="line" class="mx-auto" style="background-color:rgba(149, 64, 219, 0.91);display:none;width:50%;height:5px" align="center">
      <div id="aud" class="mx-auto" style="display:flex;justify-content:center"></div>
    </div>
    <br>
    
    <br>
    <div class="container mx-auto ">
       <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " id="histfrancais" style="background-color:#f5f5dc;padding:50px;text-align:left;display:none;border-radius: 0px 100px 100px 0px;border:1px solid black;box-shadow:0 0 15px">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="histarab" style="background-color:#f5f5dc;display:none;padding:50px;text-align:right;font-weight:600;border-radius: 100px 0px 0px 100px;border:1px solid black;box-shadow:0 0 15px">
          </div>
       </div>
    </div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
   <div class="custom-shape-divider-bottom-1640556974">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>    

  <div class="modal fade" id="edit"  >
    <div class="modal-dialog" >
      <div class="modal-content" >
        <div class="modal-body" >
          <form action="histoire.php" method="POST" enctype="multipart/form-data" onsubmit="return verifiermodifier()">
          <div class="form-group mt-3">
                <input type="file" class="form-control"  id="chosefile"   rows="5"  name="im" hidden="hidden"/>
              </div>
              <div class="form-group mt-3" style="display:flex">
              <input  type="text" readonly name="chemaine" id="m5" value="<?=$profilepicture;?>" hidden="hidden" >
              </div>
              <br>
        <img src="<?=$profilepicture;?>" width="100px" height="100px" id="fake" style="margin-left:40%;cursor:pointer;border-radius:100%;border:3px solid purple">
        <br>
        <br>
          <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Utilisateur</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="u"  value="<?=$x;?>" placeholder="Password" required>
    </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Email</label>
    <div class="col-sm-7">
      <input type="email" class="form-control" style="font-size:14px" value="<?=$email;?>" name="e" placeholder="Email" required>
    </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Mot De Passe</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" value="<?=$password;?>" placeholder="Password" name="p" required>
    </div>
  </div>
  <br>
  <br>
  <div class="form-group offset-2 row">
    <div class="col-sm-10">
      <input type="text" id="confir" class="form-control" style="text-align:center" name="conf"    placeholder="Confirmer avec Le code ci dessus" required>
    </div>
  </div>
  <br>
  <div class="text-center" id="config" style="color:red;"><?=$randomString;?></div>
<br>
<div id="remarque" class="text-center"></div>
<br>
      </div>
        <div class="modal-footer mx-auto" >
          <input class="btn btn-primary" type="submit" style="background-color:rgba(149, 64, 219, 0.91);border:0" value="Modifier" name="modi">

          </form>
          <button class="btn btn-secondary"  id="dimiss">Fermer</button>
          <script>
             const b=document.getElementById("dimiss");
          b.addEventListener("click",function(){
            window.location="histoire.php";
            });
                const real=document.getElementById("chosefile");
                const fake=document.getElementById("fake");
                const chem=document.getElementById("m5");


                fake.addEventListener("click",function(){
                  real.click();
                });
                real.addEventListener("change",function(){
                  if(real.value){
                    chem.value=real.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                    const im=this.files[0];
                    if(im){
                      const reader=new FileReader();
                      reader.addEventListener("load",function(){
                        fake.setAttribute('src',reader.result);
                      });
                      reader.readAsDataURL(im);
                    }
                  }
                });
          </script>
           <?php 
      if(isset($_POST['modi'])){
        $newuser=$_POST['u'];
        $pass=$_POST['p'];
        $newemail=$_POST['e'];
        $newphoto="";
        if($_FILES['im']['name']!=""){
          $fn=$_FILES['im']['name'];
          $locationtemp=$_FILES['im']['tmp_name'];
          move_uploaded_file($locationtemp,"uploadedimg/$x $fn");
          if($profilepicture!="assets\img\utilisateur.png"){
            unlink($profilepicture);
          }
          $newphoto="uploadedimg/$x $fn";
        }
        else{
          $newphoto=$profilepicture;
        }
        $t=UsersManager::Modifier($x,$newuser,$pass,$newemail,$email,$newphoto);
        if($t!=0){
          $_SESSION['user']=$newuser;
          $x=$_SESSION['user'];
          $_SESSION['pass']=$pass;
          $password=$_SESSION['pass'];
          ?>
          <script>
            document.getElementById('logo').click();
          </script>
          <?php
        }
       
      }
      ?>
        </div>
      </div>
    </div>
  </div> 

  <div id="acheter" class="modal fade" >
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-body">
        <center>
          <br>
          <div id="c">
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
    ?>


          </table>
          <br>
          <?php echo("<h4 align='center'>Le Total Est : $t DH</h4>"); ?>
          </div>

            </center>
            <br>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" id="cance">Fermer</button>
          <button class="btn btn-primary" id="next"  data-placement="bottom"  data-toggle="modal" data-target="#try">Completer L'achat</button>
        </div>
      </div>
    </div>
  </div>  
  </div>         

  <div id="try" class="modal fade" >
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-body">
        <form >
        <h3 align="center">Confirmer Votre Achat</h3>
    <br>
    <br>
    <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Num De Carte</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="numero" id="numero"  required>
    </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Donateur</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="doneur" id="doneur" style="font-size:14px"  required>
    </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Annee Exp</label>
    <div class="col-sm-7">
      <select id="annee" name="annee">
        <?php
        for($i=2022;$i<2035;$i++){
          echo("<option value='$i'>$i</option>");
        }
        ?>
      </select>
    </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Mois Exp</label>
    <div class="col-sm-7">
    <select  id="mois" name="mois">
        <?php
        for($i=1;$i<13;$i++){
          echo("<option value='$i'>$i</option>");
        }
        ?>
      </select>
        </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Crypto</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="crypto" id="crypto" style="font-size:14px"  required>
    </div>
  </div>
  <br>
  <div id="molahada" hidden="hidden"><h6 style="color:red" align="center">Tout Les Champs Sont Obligatoires !</h6></div>
<br>
      </div>
      
        <div class="modal-footer">
          <button class="btn btn-secondary" id="fer"  data-dismiss="modal">Fermer</button>
          <input type="button" id="yalla" value="Effectuer L'Achat!" name="yalla" class="btn btn-primary" style="background-color:rgba(149, 64, 219, 0.91);border:0">

        </form>

        </div>
      </div>
    </div>
  </div>  
  
    
    
     <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-1.11.1.min.js"></script>

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
          let x=$(this).next('input').val();
          $('#a'+x).hide();
          document.getElementById("done").innerHTML="<h6 style='color:green'>Lhistoire a ete ajoute au panier!</h6>"
          $.ajax({
            type:"POST",
            url:"addtocart.php",
            data:'id='+x
          }).done(function(res){
            $('#c').html(res);
          })

       })

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

        $('#cance').click(function(){
          var t=$('#type').val();
          $.ajax({
            type:"POST",
            url:"booksfilter.php",
            data:'filter='+t
          }).done(function(res){
            $('#result').html(res);
          })

          
        })

        $('#yalla').click(function(){
          let num=$('#numero').val();
          let don=$('#doneur').val();
          let annee=$('#annee').val();
          let mois=$('#mois').val();
          let cry=$('#crypto').val();
          if(num!="" && don!="" && cry!=""){

            $.ajax({
            type:"POST",
            url:"acheter.php",
            data:'numero='+num+'&doneur='+don+'&annee='+annee+'&mois='+mois+'&crypto='+cry
          }).done(function(res){
            $('#molahada').removeAttr('hidden');
            $('#molahada').html(res);
          })
          }
          else{
            $('#molahada').removeAttr('hidden');
          }
                  })
        
            })
    </script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
