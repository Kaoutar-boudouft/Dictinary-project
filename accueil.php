<?php 
include_once 'UsersManager.php';
include_once 'Panier.php';
       $username="";
       $password="";
       $msg="";
       if(!empty($_POST['log'])){
         $na=$_POST['username'];
         $pa=$_POST['passw'];
        
        $result=UsersManager::Login($na,$pa);
        if($result!=0){
          session_start();
          $panier=new Panier();
          $panier->importerPanier($na);
          $_SESSION['panier']=$panier;
          $_SESSION['user']=$na;
          $_SESSION['pass']=$pa;
          $_SESSION['modifier']="";

          
          if(isset($_POST['remember'])){
            setcookie("u",$na,time()+120);
            setcookie("p",$pa,time()+120);
            ?>
           <script>window.location="Add.php";</script>    
              <?php
          }
          else{
            ?>
           <script>window.location="Add.php";</script>    
              <?php
          }
        }

        else{
          $username=$na;
          $msg="<h6 style='color:red;font-size:9pt'>Vos Donnees Sont Incorrect!</h6>";

        }

      }
      else{
        if(isset($_COOKIE['u'])){
          $username=$_COOKIE['u'];
        }
        if (isset($_COOKIE['p'])) {
          $password=$_COOKIE['p'];
        }
      }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dictionary</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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
  <link href="assets/css/styleaccueil.css" rel="stylesheet">
</head>
<script>
  function verifiersign(){
                var ok=true;
                let pass1=document.getElementById('p').value;
                let pass2=document.getElementById('pc').value;
                if(pass1!=pass2)
                {
                    document.getElementById("remarque").innerHTML="<h6 style='color:red;font-size:9pt'>les deux pass doivent etre identiques !</h6>";
                    ok=false;
                }
                return ok;
            }
</script>

<body >
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">
    
          <div class="logo">
            <a href="./accueil.php"><img src="./assets/img/logo2.png"></a><span style="color: white;font-weight: bold;cursor: pointer;">OURBOOK</span>
          </div>
    
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="accueil.php">Acceuil</a></li>
              <li><a class="nav-link scrollto" href="#faq"><i class="bx bx-help-circle icon-help" style="font-size: 20pt;"></i></a></li>
        </ul>
          </nav><!-- .navbar --> 
        </div>
      </header><!-- End Header -->
      <section id="hero">

        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
              <div data-aos="zoom-out">
                  <br>
                  <br>
                <h1>Développez vos compétences linguistiques avec<span> OurBook</span></h1>
                <br>
                <h2>Apprendre avec Ourbook,
                  Enregistrez tous les nouveaux termes sur une seule plate-forme
                   en quelques étapes simples et rapides
                </h2>
                <br>
                <div class="text-center text-lg-start">
                  <a href="#sign" class="btn-get-started scrollto" style="text-decoration: none;">Rejoignez-nous</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
              <img src="assets/img/2011.i301.038_Language_courses_isometric_composition-01-removebg-preview.png" class="img-fluid animated" alt="">
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
    
      </section><!-- End Hero -->
      <br>
      <br>
      <div style="height:75px" id="signin"></div>
      <div class="form-container sign-in-form w-100" id="sign">
        <div class="form-box sign-in-box">
            <h2 >Se Connecter</h2>
 <form action="accueil.php#sign" method="POST">
                <div class="field">
                    <i class="uil uil-at"></i>
                    <input type="text" placeholder="Nom d'utilisateur" name="username" id="na" value="<?=$username; ?>" required>
                </div>
                <div class="field">
                    <i class="uil uil-lock-alt"></i>
                    <input class="password-input" type="password" name="passw"  placeholder="Mot De Passe" value="<?=$password;?>" required />
                    <div class="eye-btn"></div>
                </div>
                <div>
                        <input type="checkbox" name="remember"     value='ok'> Enregistrer mes donnees!
                    </div>
                    <br>
                    <div class="forgot-link">
                        <a href="#">Mot de passe oublie?</a>
                    </div>
                    <div><?=$msg; ?></div>
                    <input class="submit-btn" type="submit" value="Connecter" name="log" style="background-color:rgba(149, 64, 219, 0.91);;">
            </form>
            
            <div class="login-options">
                <p class="text">Ou bien se connecter avec...</p>
                <div class="other-logins">
                    <a href=""><img src="./assets/img/google.png" alt=""></a>
                    <a href=""><img src="./assets/img/facebook.png" alt=""></a>
                    <a href=""><img src="./assets/img/apple.png" alt=""></a>
                </div>
            </div>
        </div>
        <div class="imgBox sign-in-imgBox">
            <div class="sliding-link">
                <p>Vous N'avez pas de compte?</p>
                <span class="sign-up-btn" style="color: rgba(149, 64, 219, 0.91);;">S'inscrire</span>
            </div>
            <img src="./assets/img/signin-img.png" alt="">
        </div>
    </div>
    

    <div class="form-container sign-up-form w-100">
        <div class="imgBox sign-up-imgBox">
            <div class="sliding-link">
                <p>Vous Avez un deja compte?</p>
                <span class="sign-in-btn" style="color: rgba(149, 64, 219, 0.91);;">Se Connecter</span>
            </div>
            <img src="./assets/img/signup-img.png" alt="">
        </div>
        <div class="form-box sign-up-box">
            <h2 >S'inscrire</h2>
            <div class="login-options">
                <div class="other-logins">
                    <a href=""><img src="./assets/img/google.png" alt=""></a>
                    <a href=""><img src="./assets/img/facebook.png" alt=""></a>
                    <a href=""><img src="./assets/img/apple.png" alt=""></a>
                </div>
                <p class="text">ou bien s'inscrire avec...</p>
            </div>
            <form action="Accueil.php#sign" method="POST" onsubmit="return verifiersign()">
                <div class="field">
                    <i class="uil uil-at"></i>
                    <input type="email" placeholder="Email ID" name="em" id="em" required>
                </div>
                <div class="field">
                    <i class="uil uil-user"></i>
                    <input type="text" placeholder="Nom Complet" name="name" id="name" required>
                </div>
                <div class="field">
                    <i class="uil uil-lock-alt"></i>
                    <input  type="password" placeholder="Mot De Passe" name="pass" id="p" required />
                </div>
                <div class="field">
                    <i class="uil uil-lock-access"></i>
                    <input  type="password" placeholder="Confirmer le Mot De passse" id="pc" name="passc" required />
                </div> 
                <div id="remarque"></div>
                <?php 
                if(!empty($_POST['sign'])){
                  $e=$_POST['em'];
                  $n=$_POST['name'];
                  $p=$_POST['pass'];
                  $pc=$_POST['passc'];

                  
                  
                    $user=new User($n,$e,$p,"assets/img/utilisateur.png");
                    $response=UsersManager::Inscrire($user);
                    if($response==0){
                      ?>
                      <script>
                        let x=document.getElementById('na');
                        x.value='<?php echo"$n"; ?>';
                      </script>
                      <?php
                    }
                    else{
                      ?>
                      <script>
                      const signUpForm= document.querySelector(".sign-up-form");
                      const signInForm= document.querySelector(".sign-in-form");
                      const signUpBtn= document.querySelector(".sign-up-btn");
                      const signInBtn= document.querySelector(".sign-in-btn");
                      signInBtn.addEventListener("click", () => {
                      signInForm.classList.remove("hide");
                      signUpForm.classList.remove("show");
                      signInForm.classList.add("show"); });
                      signUpBtn.addEventListener("click", () => {
                      signInForm.classList.add("hide");
                      signUpForm.classList.add("show");
                      signInForm.classList.remove("show");});
                      signInForm.classList.add("hide");
                      signUpForm.classList.add("show");
                      signInForm.classList.remove("show");
                      let s=document.getElementById('em');
                      s.value='<?php echo"$e"; ?>';
                      let x=document.getElementById('name');
                      x.value='<?php echo"$n"; ?>';
                    </script>
                    <?php
                      echo "<h6 style='color:red;font-size:9pt'>Ce compte deja existe</h6>";
                  }
                  

                }
                
                ?>
                    <input class="submit-btn" type="submit" value="S'inscrire" name="sign" style="background-color:rgba(149, 64, 219, 0.91);;">
            </form>
           
        </div>
       
    </div>


    <script>
        const textInputs=document.querySelectorAll("input");
        textInputs.forEach(textInput =>{
            textInput.addEventListener("focus", () => {
                let parent= textInput.parentNode;
                parent.classList.add("active");
            });
            textInput.addEventListener("blur", () => {
                let parent= textInput.parentNode;
                parent.classList.remove("active");
            });
        });

        // password show-hide
        const passwordInput=document.querySelector(".password-input");
        const eyeBtn=document.querySelector(".eye-btn");
        
        eyeBtn.addEventListener("click", () => {
            if(passwordInput.type === "password"){
                passwordInput.type = "text";
                eyeBtn.innerHTML = "<i class='uil uil-eye'></i>";
            }
            else{
                passwordInput.type= "password";
                eyeBtn.innerHTML = "<i class='uil uil-eye-slash'></i>"
            }
        });

        //animation
        const signUpBtn= document.querySelector(".sign-up-btn");
        const signInBtn= document.querySelector(".sign-in-btn");
        const signUpForm= document.querySelector(".sign-up-form");
        const signInForm= document.querySelector(".sign-in-form");

        signUpBtn.addEventListener("click", () => {
            signInForm.classList.add("hide");
            signUpForm.classList.add("show");
            signInForm.classList.remove("show");

        });

        signInBtn.addEventListener("click", () => {
            signInForm.classList.remove("hide");
            signUpForm.classList.remove("show");
            signInForm.classList.add("show");


        });
  </script>
   <br>
   <br>
   <div id="whitespace" ></div>
    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg p-4">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>F.A.Q</h2>
          <p>Les questions les plus courantes</p>
        </div>

        <div class="faq-list">
          <ul>

            <li data-aos="fade-up" style="box-shadow:0 0 5px black">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Qui sommes-nous ?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                une plateforme digital vise à faciliter le processus d’apprentissage de la langue Français.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100" style="box-shadow:0 0 5px black">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Comment s’inscrire ?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  3 etapes pas de 4eme!   <br>
                  cliker sur s'inscrire!   <br>
                  remplir la formulaire attentivement!   <br>
                  et voila Bienvenue dans notre communauté!
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200" style="box-shadow:0 0 5px black">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Pourquoi OURBOOK ? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                Pour faciliter le processus d’apprentissage de la langue Français et aussi pour eviter le gaspillage de temps et de papier!
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300" style="box-shadow:0 0 5px black">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Comment on peut vous-contactez ? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p class="text-center" style="display:flex;justify-content:inline;margin-left:50%">
                <a href="https://www.instagram.com/Ctrl_Z_Company/"><i class="bi bi-instagram" style="font-size:24px" ></i></a>
                <a href=""><i class="bi bi-github" style="font-size:24px" ></i></a>
                <a href="https://mail.google.com/mail/u/0/#inbox?compose=new"><i class="bi bi-envelope" style="font-size:24px" ></i></a>
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End F.A.Q Section -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
   <div class="custom-shape-divider-bottom-1640556974">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>      <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>