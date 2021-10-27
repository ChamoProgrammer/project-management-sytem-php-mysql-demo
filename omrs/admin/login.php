<?php
session_start();
error_reporting(0);  //ESTABLECE ERRORES Y EN CUANTO TIEMPO
include('includes/dbconnection.php');

// iniciar sesion
if(isset($_POST['login'])) 
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['omrsaid']=$result->ID;
}

  if(!empty($_POST["remember"])) {
//COOKIES for username
setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
} else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
        }
      }
}
$_SESSION['login']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
   

    <title>Sistema de registro de matrimonio en línea || Página de inicio de sesión de administrador</title>

    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">

    <!-- Amanda CSS -->
    <link rel="stylesheet" href="css/amanda.css">
  </head>

  <body>

    <div class="am-signin-wrapper">
      <div class="am-signin-box">
        <div class="row no-gutters">
          <div class="col-lg-5">
            <div>
              <h2>SMRL</h2>
              <p>bienvenido/a al panel de administracion</p>
              <p>Hasta que el fútbol, ​​las úlceras, el fútbol infantil, el precio de uno, ensalada. No hay una receta única para la misa. Solo hasta el pie y ordenado por no plátanos, ternera.</p>

              <hr>
              <p><br> <a href="../index.php">Regresar A Inicio</a></p>
            </div>
          </div>
          <div class="col-lg-7">
            <h5 class="tx-gray-800 mg-b-25">Inicia sesión en tu cuenta</h5>
 <form class="form-auth-small" action="" method="post">
            <div class="form-group">
              <label class="form-control-label">Nombre De Usuario:</label>
              <input type="text" class="form-control" placeholder="Nombre de Usuario" required="true" name="username" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" >
            </div><!-- form-group -->

            <div class="form-group">
              <label class="form-control-label">contraseña:</label>
              <input type="password" class="form-control" placeholder="contraseña...🗝" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
            </div><!-- form-group -->
<div class="form-group">
              <label class="fancy-checkbox element-left">
               <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
                <span>Recordarme</span>
               </label>  
            </div>
           

            <button type="submit" class="btn btn-block" name="login">Iniciar Sesion</button>
             <div class="form-group mg-b-20" style="padding-top: 20px"><a href="forgot-password.php">Restablecer Contraseña</a></div>
          </div>
         </form>
        </div><!-- row -->
        <p class
        ="tx-center tx-white-5 tx-12 mg-t-15">sistema de matrimonio @ 2021</p>
      </div><!-- signin-box -->
    </div><!-- am-signin-wrapper -->

    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <script src="js/amanda.js"></script>
  </body>
</html>
