<?php 
include_once 'DictManager.php';
session_start();
$user=$_SESSION['user'];
$_SESSION['modifier']="";
$z=$_GET['mfind'];
if(empty($z) || empty($user)){
  header("location:rechercher.php?filter=all#wrapper");
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
  <link href="assets/css/modifier.css" rel="stylesheet">
  
    <title>ADMIN_AREA</title>
</head>
<body>
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">
    
          <div class="logo">
            <a href="Add.php"><img src="./assets/img/logo2.png"></a><span style="color: white;font-weight: bold;cursor: pointer;">OURBOOK</span>
          </div>
    
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto" href="#add">Modifier un Mot</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </header><!-- End Header -->
    <br>
    <br>
    <br>
    <br>
<br>
      <!-- ======= Add Section ======= -->
    <section id="add" class="add">
      <div class="container">

        <div class="section-title text-center" data-aos="fade-up">
          <h2 style="font-weight: bold;">Corriger Et Améliorer Vos Mots Facilement !</h2>
        </div>
        <br>
        <div class="row">
            
        
          
          <div class="col-lg-8 mt-5 mt-lg-0 mx-auto" data-aos="fade-left" data-aos-delay="200">

            <form class="ajout" action="" method="POST" enctype="multipart/form-data">
              <div class="row">

                <div class="col-md-6 form-group">
                  <input type="text" class="form-control" readonly  placeholder="الكلمة بالعربية" name="ar" id="m1" required style="text-align:right">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" readonly placeholder="Le Mot Equivalent En Francais" id="m2" name="fr" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" placeholder="Signification" name="si" id="m3" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" rows="5" placeholder="Des Examples" name="ex" id="m4" required></textarea>
              </div>
              <div class="form-group mt-3">
                <input type="file" class="form-control"  id="chosefile" hidden="hidden"  rows="5"  name="im"/>
              </div>
              <div class="form-group mt-3" >
                <button type="button" id="fake" style="border:0;padding:8px;background-color:black;color:white">Chose File</button>
                <br>
              <input  type="text" readonly name="chemaine" id="m5" style="border:0">
              </div>
              <br>
              <script>
                const real=document.getElementById("chosefile");
                const fake=document.getElementById("fake");
                const chem=document.getElementById("m5");

                fake.addEventListener("click",function(){
                  real.click();
                })
                real.addEventListener("change",function(){
                  if(real.value){
                    chem.value=real.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                  }
                })
              </script>
              <div style="display: flex;"><div class="text-center"><input type="submit" value="Modifier Maintenant!" name="modifier" id="" style="background: #000000;border: 0;padding: 10px 30px;color: #fff;transition: 0.4s;border-radius: 50px;"></div>
              <div class="text-center"></div> <a href="rechercher.php" style="background: #000000;border: 0;text-decoration:none;margin-left:5px;padding: 10px 30px;color: #fff;transition: 0.4s;border-radius: 50px;">Annuler La Modification</a></div>
              
            </form>
          </div>

        </div>

      </div>
     
    </section><!-- End  -->
    <?php

            if(isset($_GET['mfind'])){                
                $r=DictManager::GetRowById($z);
                while($row=$r->fetch()){
                  $a=$row[1];
                  $f=$row[2];
                  $s=$row[3];
                  $e=$row[4];
                  $p=$row[5];
                }
                ?>
                <script>
                  let x=document.getElementById('m1');
                  x.value='<?php echo"$a"; ?>';
                  let xx=document.getElementById('m2');
                  xx.value='<?php echo"$f"; ?>';
                  let xxx=document.getElementById('m3');
                  xxx.value='<?php echo"$s"; ?>';
                  let xxxx=document.getElementById('m4');
                  xxxx.value='<?php echo"$e"; ?>';
                  let y=document.getElementById('m5');
                  y.value='<?php echo"$p"; ?>';
                 

                </script>
                <?php
                
                  
               
            }
            if(isset($_POST['modifier'])){
              if($_FILES['im']['name']!=""){
                $ara=$_POST['ar'];
                $fra=$_POST['fr'];
                $sig=$_POST['si'];
                $exe=$_POST['ex'];
                $fn=$_FILES['im']['name'];
                $locationtemp=$_FILES['im']['tmp_name'];
                $ci=DictManager::GetIdByWords($ara,$fra,$user);
                $di=DictManager::GetImageById($ci);
                unlink($di);
                move_uploaded_file($locationtemp,"uploadedimg/$ci $fn");
                $d=new Dict($ara,$fra,$sig,$exe,"uploadedimg/$ci $fn",$user);
                $r=DictManager::modifier($d,$ci);


                }
                            
              else{
                $ara=$_POST['ar'];
                $fra=$_POST['fr'];
                $sig=$_POST['si'];
                $exe=$_POST['ex'];
                $pho=$_POST['chemaine'];
                $d=new Dict($ara,$fra,$sig,$exe,$pho,$user);
                $ci=DictManager::GetIdByWords($ara,$fra,$user);
                $r=DictManager::modifier($d,$ci);
                            }

                            $_SESSION['modifier']="true";
                            ?>
                            <script>
                              window.location="rechercher.php#wrapper";
                            </script>
                            <?php
                
            }

            ?>
    
    <br>
   <div class="custom-shape-divider-bottom-1640556974">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>    
     <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>