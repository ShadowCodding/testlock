<?php

include "lang.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit User - <?php echo @$language["SystemName"];?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="shortcut icon" href="/assets/favicon.ico" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  </head>
  <body>
    <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" style="margin-left:12%;" href="index.html"><img src="/assets/staylogo.png" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="/assets/staylogo.png" alt="logo" /></a>
        </div>
        <ul class="nav">
          <?php include("module/nav.view.php"); ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container page-body-wrapper" style="max-width: 100% !important;">
        <!-- partial:partials/_navbar.html -->
        <?php include("module/altheader.view.php"); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="/assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Do you need more licenses and features?</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">you can upgrade to any package with 1-2 clicks!</p>
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
                          <a href="<?=$discordInvite?>" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade Package</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit User - <?= $id?></h4>
                    <form class="forms-sample" action="/users/<?= $id?>" method="POST">
                      <?php
                        $query = $db->query("SELECT * FROM accounts WHERE id='$id'", PDO::FETCH_ASSOC);
                        if ($query->rowCount()){
                            foreach( $query as $row ){?>
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="<?= $row["name"]?>" style="color:white;" name="name" id="exampleInputUsername1" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>E-Mail</label>
                        <input type="text" class="form-control" value="<?= $row["email"]?>" style="color:white;" name="email" id="exampleInputUsername1" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" value="<?= $row["username"]?>" style="color:white;" name="username" id="exampleInputUsername1" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" value="" style="color:white;" name="password" placeholder="(if you don't want to change password type anything)">
                      </div>

                      <div class="form-group">
                        <label>Script Count</label>
                        <input type="text" class="form-control" value="<?= $row["sc_count"]?>" style="color:white;" name="sc_count" id="exampleInputUsername1" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>License Count</label>
                        <input type="text" class="form-control" value="<?= $row["lc_count"]?>" style="color:white;" name="lc_count" id="exampleInputUsername1" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>Permission</label>
                        <select class="form-control" name="permission" style="width:100%">
                          <option value="0" <?php if ($row["permission"] == "0"){echo 'selected';} ?>>User</option>
                          <option value="1" <?php if ($row["permission"] == "1"){echo 'selected';} ?>>Bronze</option>
                          <option value="2" <?php if ($row["permission"] == "2"){echo 'selected';} ?>>Silver</option>
                          <option value="3" <?php if ($row["permission"] == "3"){echo 'selected';} ?>>Diamond</option>
                          <option value="4" <?php if ($row["permission"] == "4"){echo 'selected';} ?>>Premium</option>
                          <option value="5" <?php if ($row["permission"] == "5"){echo 'selected';} ?>>Admin</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" style="width:100%">
                          <option value="false" <?php if ($row["active"] == "false"){echo 'selected';} ?>>Deactive</option>
                          <option value="true" <?php if ($row["active"] == "true"){echo 'selected';} ?>>Active</option>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-primary mr-2">Update</button>
                      <?php
                            }
                        }
                      ?>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->

          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"><?php echo @$language["userCopyright"];?></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/assets/js/dashboard.js"></script>
    <script src="/assets/js/jquery.dataTables.js" ></script>
    <script src="/assets/js/misc.js"></script>
    <!-- End custom js for this page -->
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>
    
  </body>
</html>