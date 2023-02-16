<?php

include "lang.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets/login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="assets/login/css/style.css">

    <title><?php echo @$language["loginTitle"];?> - <?php echo @$language["SystemName"];?></title>
  </head>
  <body>
  

  <div class="d-md-flex half">
    <div class="contents" style="width: 100%;">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 style="font-weight: 600;"><?php echo @$language["loginTitle"];?></h3>
                <p>You must be logged in to continue.</p>
              </div>
              <?php
              $id = @$_REQUEST["id"];
              
              if(isset($id)){
                if($id == "0"){
                  echo "<div class='alert alert-success' role='alert'>
                  You have successfully logged in. You are being redirected.
                </div>";
                echo "<script>setTimeout(function(){
                  window.location.href = '/main';
              }, 2000);</script>
              ";
                }
                if($id == "1"){
                  echo '<div class="alert alert-danger" role="alert">
                  Wrong password combination!
                </div>';
                }
                if($id == "2"){
                  echo '<div class="alert alert-danger" role="alert">
                  No such account found!
                </div>';
                }
              }
				
				if($onlyDiscordLogin == false){
              ?>
              <form action="/login" method="post">
                <div class="form-group first">
                  <label for="username"><?php echo @$language["loginUsernameoremail"];?></label>
                  <input type="text" class="form-control" name="username" placeholder="name@example.com" id="username">
                </div>
                <div class="form-group last mb-3">
                  <label for="password"><?php echo @$language["loginPassword"];?></label>
                  <input type="password" class="form-control" name="password" placeholder="********" id="password">
                </div>

                <div class="mb-3 text-center">
                  <span class="ml-auto">Don't have an account? <a href="/register">Create now!</a></span>
                </div>

                <input type="submit" value="<?php echo @$language["loginLogin"];?>" class="btn btn-block py-2 btn-primary">
                <hr style="width: 30%;">
              </form>  
				<?php }?>
              <form action="/login/discord" method="post">
                <input type="submit" value="Login with Discord" class="btn btn-block py-2 btn-primary" style="background-color: #6c89e0; border:none; width: auto; margin: auto;">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="assets/login/js/jquery-3.3.1.min.js"></script>
    <script src="assets/login/js/popper.min.js"></script>
    <script src="assets/login/js/bootstrap.min.js"></script>
    <script src="assets/login/js/main.js"></script>
  </body>
</html>