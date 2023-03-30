<?php 
include_once 'DictManager.php';
include_once 'UsersManager.php';
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['pass'];
if(empty($user)){
  header("location:accueil.php");
}
$email=UsersManager::GetEmailByUsername($user);
$profilepicture=UsersManager::GetPofilePictureByUsername($user);
$n=15;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
  <link href="assets/css/styleadd.css" rel="stylesheet">
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
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">
    
          <div class="logo">
            <a href="Add.php" id="logo"><img src="./assets/img/logo2.png"></a><span style="color: white;font-weight: bold;cursor: pointer;">OURBOOK</span>
          </div>
    
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="#head">Accueil</a></li>
              <li><a class="nav-link scrollto" href="#add">Ajouter des mots</a></li>
              <li><a class="nav-link scrollto" href="./rechercher.php#wrapper">Rechercher par mots</a></li>
              <li><a class="nav-link scrollto" href="./histoire.php">Bibliotheque</a></li>
              <li><div class="dropdown">
              <a class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php echo("$user"); ?>
</a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             <img src="<?=$profilepicture;?>"  width="50px" height="50px" style="margin-left:50px;border-radius:100%;border:3px solid purple">
             <a class="dropdown-item" style="color:black" href=""  data-toggle="modal" data-target="#edit">Parametres</a>
             <a class="dropdown-item" style="color:black" href="logout.php">Deconnecter</a>
            </div>
            </div>
              </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </header><!-- End Header -->
      <section id="head">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-4 order-1 order-lg-1 hero-img" data-aos="zoom-out" data-aos-delay="300">
                <br>
                <br>
              <img src="assets/img/undraw_collaborating_re_l43g.svg" class="img-fluid animated" alt="">
            </div>
            <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-2 d-flex align-items-center">
              <div data-aos="zoom-out">
                  <br>
                  <br>
                <h1><span>OurBook</span> Votre Dictionnaire De Poche</h1>
                <br>
                <h2>Ajouter Des Mots À votre Dictionnaire Pour Améliorer Votre Apprentissage.Ajouter Tout les mots que vous interessez dans Votre Book Maintenant !!
                    
                </h2>
                <br>
                <div class="text-center text-lg-start">
                  <a href="#add" class="btn-get-started scrollto" style="text-decoration: none;">Ajouter !</a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
    
        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
          <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
          </defs>
          <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
          </g>
          <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
          </g>
          <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
          </g>
        </svg>
    
      </section><!-- End  -->
      <br>
      <br>
      <!-- ======= Add Section ======= -->
    <section id="add" class="add">
      <div class="container">

        <div class="section-title text-center" data-aos="fade-up">
          <h2 style="font-weight: bold;">Ajouter Un Mot A Votre Dictionnaire Propre</h2>
        </div>
        <br>
        <br>
        <div class="row">

          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="info">
              <div class="a">
                <i class="bi bi-plus-circle"></i>
                <h4>Ajouter.</h4>
              </div>

              <div class="b">
                <i class="bi bi-book"></i>
                <h4>Reviser.</h4>
                <p></p>
              </div>

              <div class="c">
                <i class="bi bi-bookmark-check"></i>
                <h4>Apprendre.</h4>
              </div>
<br>
            </div>

          </div>

          
          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">

            <form class="ajout" action="Add.php#add" method="POST" enctype="multipart/form-data">
            <?php 
            
            
            if(!empty($_POST['add'])){
              $ara=$_POST['ar'];
              $fra=$_POST['fr'];
              $sig=$_POST['si'];
              $exe=$_POST['ex'];
              $nf=$_FILES['im']['name'];
              $locationtemp=$_FILES['im']['tmp_name'];
              $li=DictManager::GetLastId()+1;
              move_uploaded_file($locationtemp,"uploadedimg/$li $nf");
              $d=new Dict($ara,$fra,$sig,$exe,"uploadedimg/$li $nf",$user);
              $r=DictManager::addmot($d);

              if($r!=0){echo("<h6 style='color:red;font-size:12pt'>le mot deja existe!</h6>");}
              else{echo("<h6 style='color:green;font-size:12pt'>lajout a ete bien effectue!</h6>");}


            }
            ?>
              <div class="row">

                <div class="col-md-6 form-group">
                  <input type="text" class="form-control"  placeholder="الكلمة بالعربية" name="ar" id="m1" required style="text-align:right">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" placeholder="Le Mot Equivalent En Francais" id="m2" name="fr" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" placeholder="Signification" name="si" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" rows="5" placeholder="Des Examples" name="ex" required></textarea>
              </div>
              <div class="form-group mt-3">
                <input type="file" class="form-control"  rows="5"  name="im" required/>
              </div>
              <div style="display: flex;"><div class="text-center"><input type="submit" value="Ajouter A mon Dictionnaire" name="add" id="" style="background: #000000;border: 0;padding: 10px 30px;color: #fff;transition: 0.4s;border-radius: 50px;"></div>
              <div class="text-center"><button type="Reset">Effacer Tout</button></div></div>
              
            </form>
          <?php
          if(!empty($_GET['mot'])){
            $m=$_GET['mot'];
            if(preg_match("/[a-z]/i", $m)){
            ?>
          <script>
            let s=document.getElementById('m2');
            s.value='<?php echo"$m"; ?>';
          </script>
          <?php
          }
          else {
            ?>
            <script>
              let s=document.getElementById('m1');
              s.value='<?php echo"$m"; ?>';
            </script>
            <?php
          }
          }
          ?>
          </div>

        </div>

      </div>
    </section><!-- End  -->
    <br>
    <br>
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
          <form action="Add.php" method="POST" enctype="multipart/form-data" onsubmit="return verifiermodifier()">
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
      <input type="text" class="form-control" name="u"  value="<?=$user;?>" placeholder="Password" required>
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
            window.location="Add.php";
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
          move_uploaded_file($locationtemp,"uploadedimg/$user $fn");
          if($profilepicture!="assets\img\utilisateur.png"){
            unlink($profilepicture);
          }
          $newphoto="uploadedimg/$user $fn";
        }
        else{
          $newphoto=$profilepicture;
        }
        $t=UsersManager::Modifier($user,$newuser,$pass,$newemail,$email,$newphoto);
        if($t!=0){
          $_SESSION['user']=$newuser;
          $user=$_SESSION['user'];
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
     <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js" ></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-1.11.1.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>