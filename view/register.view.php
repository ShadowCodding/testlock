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

    <link rel="stylesheet" href="/assets/login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="/assets/login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="/assets/login/css/style.css">

    <title><?php echo @$language["registerTitle"];?> - <?php echo @$language["SystemName"];?></title>
  </head>
  <body>
  

  <div class="d-md-flex half">
    <div class="contents">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="" style="font-weight: 600;">Register</h3>
              </div>
              <?php
              $id = @$_REQUEST["id"];
              
              if(isset($id)){
                if($id == "0"){
                  echo "<div class='alert alert-success' role='alert'>
                  You have successfully registered. You are being redirected.
                </div>";
                echo "<script>setTimeout(function(){
                  window.location.href = '/login';
              }, 2000);</script>
              ";
                }
                if($id == "1"){
                  echo '<div class="alert alert-danger" role="alert">
                  There is a user registered with this username and email.
                </div>';
                }
              }

              ?>
              <form action="/register" method="post">

                <div class="form-group first">
                  <label for="username"><?php echo @$language["registerNameandsurname"];?></label>
                  <input type="text" class="form-control" name="name" placeholder="Otis Milburn" id="name" require>
                </div>

                <div class="form-group first">
                  <label for="username"><?php echo @$language["registerUsername"];?></label>
                  <input type="text" class="form-control" name="username" placeholder="myusername69" id="username" require>
                </div>

                <div class="form-group last mb-3">
                  <label for="password"><?php echo @$language["registerEmail"];?></label>
                  <input type="email" class="form-control" name="email" placeholder="test@example.com" id="email" require>
                </div>

                <div class="form-group last mb-3">
                  <label for="password"><?php echo @$language["registerPassword"];?></label>
                  <input type="password" class="form-control" name="password" placeholder="********" id="password" require>
                </div>
                <br>

                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption"><?php echo @$language["registerEmailnotification"];?></span>
                    <input type="checkbox" name="check" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="/login" class="forgot-pass">Sign in</a></span>
                </div>

                <input type="submit" value="<?php echo @$language["registerRegister"];?>" class="btn btn-block py-2 btn-primary">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="/assets/login/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/login/js/popper.min.js"></script>
    <script src="/assets/login/js/bootstrap.min.js"></script>
    <script src="/assets/login/js/main.js"></script>
  </body>
</html>