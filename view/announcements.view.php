<?php

include "lang.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Announcements - <?php echo @$language["SystemName"];?></title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
              <!-- <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="/assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Daha fazla lisansa ve özelliğemi ihtiyacın var?</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">1-2 tık ile dilediğin pakete yükseltebilirsin!</p>
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
                          <a href="https://www.bootstrapdash.com/product/corona-admin-template/" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Paketini Yükselt</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->

            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="float:left !important;">Announcements</h4>
                    <a href="/announcements/new" class="btn btn-success" style="float:right !important;">Create Announcement</a>
                    <div class="table-responsive">
                      <table id="myTable" class="table">
                        <thead>
                          <tr>
                              <th>#</th>
                              <th>Title</th>
                              <th>Data</th>
                              <th>Time</th>
                              <th>Writer</th>
                              <th>Status</th>
                              <th>#</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $db->query("SELECT * FROM announcements",PDO::FETCH_ASSOC);
                                while ($row = $query->fetch()):
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']) ?></td>
                                <td><?php echo htmlspecialchars($row['title']) ?></td>
                                <td><?php
                                  $string = $row["data"];
                                  $stringall=strlen($string);
                                  $striphtml = strip_tags($string);
                                  $stringnohtml=strlen($striphtml);
                                  $differ=($stringall-$stringnohtml);
                                  $stringsize=($differ + 50);
                                  $limited = substr($string, 0, $stringsize).'...';
                                  echo htmlspecialchars($limited) 
                                ?></td>
                                <td><?php echo htmlspecialchars(date('o-m-d H:i:s', $row["time"])) ?></td>
                                <td>
                                <?php

                                  $ownerid = $row["writer"];

                                  $queryy = $db->query("SELECT * FROM accounts WHERE id='$ownerid'", PDO::FETCH_ASSOC);
                                  if ($queryy->rowCount()){
                                    foreach( $queryy as $cum ){
                                      $name = $cum["name"];
                                    }
                                  }

                                  echo htmlspecialchars($name);

                                 ?>
                                </td>
                                <td>
                                <?php
                                    if($row['public'] == "true"){
                                        echo '<label class="badge badge-success" style="background: #00ff6c24; color: #00ff6c;">Public</label>';
                                    }else{
                                        echo '<label class="badge badge-danger" style="background: #fc424a3b;color: #fc424a;">Private</label>';
                                    }
                                ?>
                                </td>

                                <td><a href="/announcements/edit/<?php echo htmlspecialchars($row['id']) ?>" class="btn btn-primary ml-2">Edit</a><a href="/admin/delete/announcements/<?php echo htmlspecialchars($row['id']) ?>" class="btn btn-danger ml-2">Delete</a></td>
                    		    </tr>
                          <?php endwhile; ?>			
                        </tbody>
                      </table>
                    </div>
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