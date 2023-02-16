<?php

include "lang.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo @$language["userPageTitle"];?> - <?php echo @$language["SystemName"];?></title>
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

            <?php
              $userid = $_SESSION["id"];
              $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
              if ($query->rowCount()){
                  foreach( $query as $row ){
                    $licensecount = $row["lc_count"];
                    $scriptcount = $row["sc_count"];
                  }
              }

              $query = $db->query("SELECT * FROM scripts WHERE owner='$userid'", PDO::FETCH_ASSOC);
              $activescripts = $query->rowCount();
            ?>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 col-xxl-3 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?= $scriptcount?></h2>
                        </div>
                        <h6 class="text-muted font-weight-normal">Available Scripts</h6>
                      </div>
                      <div class="col-4 text-center text-xl-right">
                        <i class="icon-lg fas fa-folder-plus text-primary ms-auto" style="position: absolute;top: 0;bottom: 0;right: 0;padding-top: 7px;font-size: 2.75rem !important;padding-right: 35px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 col-xxl-3 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?= $licensecount?></h2>
                        </div>
                        <h6 class="text-muted font-weight-normal">Available Licenses</h6>
                      </div>
                      <div class="col-4 text-center text-xl-left">
                        <i class="icon-lg fas fa-lock text-danger ms-auto" style="position: absolute;top: 0;bottom: 0;right: 0;padding-top: 7px;font-size: 2.75rem !important;padding-right: 35px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 col-xxl-3 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?=$activescripts?></h2>
                        </div>
                        <h6 class="text-muted font-weight-normal">Script count</h6>
                      </div>
                      <div class="col-4 text-center text-xl-right">
                        <i class="icon-lg fas fa-folder text-warning ms-auto" style="position: absolute;top: 0;bottom: 0;right: 0;padding-top: 7px;font-size: 2.75rem !important;padding-right: 35px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 col-xxl-3 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?php
                          
                          if ($permission == 0){
                            echo 'None';
                          }elseif($permission == 1){
                            echo 'Bronze';
                          }elseif($permission == 2){
                            echo 'Silver';
                          }elseif($permission == 3){
                            echo 'Diamond';
                          }elseif($permission == 4){
                            echo 'Premium';
                          }elseif($permission == 5){
                            echo 'Admin';
                          }
                          
                          ?></h2>
                        </div>
                        <h6 class="text-muted font-weight-normal">Membership Status</h6>
                      </div>
                      <div class="col-4 text-center text-xl-right">
                        <i class="icon-lg fas fa-user text-success ms-auto" style="position: absolute;top: 0;bottom: 0;right: 0;padding-top: 7px;font-size: 2.75rem !important;padding-right: 35px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo @$language["userRegisteredScripts"];?></h4>
                    <div class="table-responsive">
                      <script>
                        $(document).ready(function() {

                          $(document).on('click', '.delete-row-license', function(e){
                              e.preventDefault();

                              var id = $(this).attr('id');
                              var modalid = $(this).attr('value');

                              var modal = document.getElementById("exampleModal"+modalid);
                              var modal2 = modal.querySelector('.modal-dialog');
                              var modal3 = modal2.querySelector('.modal-content');
                              var modal4 = modal3.querySelector('.modal-body');
                              var table = modal4.querySelector('.table-responsive');
                              var table2 = table.querySelector('.table');
                              var table3 = table2.querySelector('.classbody');

                              modal4.innerHTML = "Yükleniyor...";
                              

                              $.post( "/api/delete/license/" + id, { modalid: modalid }).done(function(data) {
                              
                              modal4.innerHTML = '<div class="table-responsive"><table id="myTable" class="table" style="background-color: #fff0"><thead><tr><th>#</th><th>IP</th><th><?php echo @$language["userStatus"];?></th><th><?php echo @$language["userComment"];?></th><th><?php echo @$language["userDeadline"];?></th><th><?php echo @$language["userSettings"];?></th></tr></thead><tbody class="classbody"></tbody></table></div>';
                              
                              modal = document.getElementById("exampleModal"+modalid);
                              modal2 = modal.querySelector('.modal-dialog');
                              modal3 = modal2.querySelector('.modal-content');
                              modal4 = modal3.querySelector('.modal-body');
                              table = modal4.querySelector('.table-responsive');
                              table2 = table.querySelector('.table');
                              table3 = table2.querySelector('.classbody');
                              
                              console.log(data);
                              var arrayData = JSON.parse(data);
                              console.log(arrayData);
                              table3.innerHTML = "";
                              let total = arrayData.length;
                              
                              $.each(arrayData,function(index, value){
                                var status;
                                if(value["status"] == "active"){
                                  status = "<span style='color: green;'><?php echo @$language["userActive"];?><span>";
                                }else{
                                  status = "<span style='color: red;'><?php echo @$language["userDeactive"];?><span>";
                                }
                                table3.innerHTML = table3.innerHTML + '<tr><td>' + value["id"] + '</td><td>' + value["ip"] + '</td><td>' + status + '</td><td>' + value["variables"] + '</td><td>' + value["deadline"] + '</td><td><button id="' + value["id"] + '" value="' + modalid + '" class="btn btn-danger delete-row-license"><?php echo @$language["userDelete"];?></a></button><a href="/user/edit/license/' + value["id"] + '" class="btn btn-primary ml-2">Edit</a></td></tr>';
                              });

                              var sccount = document.getElementById("count"+modalid);
                              sccount.innerHTML = total;

                            });

                          });
                        });
                      </script>
                      <table id="myTable" class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th><?php echo @$language["userScript"];?></th>
                            <th><?php echo @$language["userIpcount"];?></th>
                            <th><?php echo @$language["userStatus"];?></th>
							<th>Comment</th>
                            <th><?php echo @$language["userSettings"];?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                              $username = $_SESSION["id"];
                              $query = $db->query("SELECT * FROM scripts WHERE owner='$username'",PDO::FETCH_ASSOC);
                              while ($row = $query->fetch()):
                          ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']) ?></td>
                                <td><?php echo htmlspecialchars($row['script']) ?></td>
                                <td id="count<?php echo htmlspecialchars($row['id']) ?>">
                                <?php 
                                  $nRows = $db->query("select count(*) from licenses where script='" . $row['id'] . "'")->fetchColumn(); 
                                  echo $nRows;
                                ?></td>
                                <td>
                                    <?php
                                    if($row['status'] == "active"){
                                        echo '<label class="badge badge-success" style="background: #00ff6c24; color: #00ff6c;">' . $language["userActive"] . '</label>';
                                    }else{
                                        echo '<label class="badge badge-danger" style="background: #fc424a3b;color: #fc424a;">' . $language["userDeactive"] . '</label>';
                                    }
                                    ?>
                                </td>
								<td><?php echo htmlspecialchars($row['variables']) ?></td>
                                <td>
                                    <?php
                                        $rowid =  $row["id"];
                                        if ($row["status"] == "active"){
                                          $isactive = "<span style='color: green;'>" . $language["userActive"] . "<span>";
                                          $allah = '<a href="/api/deactive/script/' . $row["id"] . '" class="btn btn-danger ml-2">Do Deactive</a>';
                                        }else{
                                          $isactive = "<span style='color: red;'>" . $language["userDeactive"] . "<span>";
                                          $allah = '<a href="/api/active/script/' . $row["id"] . '" class="btn btn-success ml-2">Do Active</a>';
                                        }
                                        echo '<a href="/user/add-ip/' . $row["id"] . '" class="btn btn-success">' . $language["userNewip"] . '</a><button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#exampleModal' . $row["id"] . '">
                                        ' .  $language["userViewip"] . '
                                      </button>
                                      
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal' . $row["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
                                          <div class="modal-content" style="background-color:#191c24;">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">' . htmlspecialchars($row['script']) . '</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="table-responsive">
                                              <table id="myTable" class="table" style="background-color: #fff0">
                                                <thead>
                                                  <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>IP</th>
                                                    <th>' .  $language["userStatus"] . '</th>
                                                    <th>' .  $language["userComment"] . '</th>
                                                    <th>' .  $language["userDeadline"] . '</th>
                                                    <th>' .  $language["userSettings"] . '</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                ';

                                                $scriptid = $row["id"];
                                                $queryy = $db->query("SELECT * FROM licenses WHERE script='$scriptid'",PDO::FETCH_ASSOC);
                                                foreach ($queryy as $row) {
                                                    $isactive;
                                                    $description;

                                                    
                                                    if ($row["status"] == "active"){
                                                      $isactive = "<span style='color: green;'>" . $language["userActive"] . "<span>";
                                                    }else{
                                                      $isactive = "<span style='color: red;'>" . $language["userDeactive"] . "<span>";
                                                    }
                                                    echo '<tr>
                                                    <td>' . htmlspecialchars($row["id"]) . '</td>
                                                    <td>' . htmlspecialchars($row["name"]) . '</td>
                                                    <td>' . htmlspecialchars($row["ip"]) . '</td>
                                                    <td>' . $isactive . '</td>
                                                    <td>' . htmlspecialchars($row["variables"]) .  '</td>
                                                    <td>' . htmlspecialchars($row["deadline"]) . '</td>
                                                    <td><button id="' . $row["id"] . '" value="' . $scriptid . '" class="btn btn-danger delete-row-license">' . $language["userDelete"] . '</button><a href="/user/edit/license/' . $row["id"] . '"  class="btn btn-primary ml-2">Edit</button></td>
                                                  </tr>';
                                                } 
                                                echo '
                                                </tbody>
                                              </table>
                                            </div>
                                            </div>

                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">' . $language["userClose"] . '</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div><a href="/user/delete/script/' . $rowid . '" class="btn btn-danger ml-2">' . $language["userDelete"] . '</a><a href="/api/download/' . $rowid . '" class="btn btn-warning ml-2">' . $language["userDownload"] . '</a>' . $allah . '<a href="/user/edit/script/' . $rowid . '" class="btn btn-primary ml-2">Edit</a>'; 
                                      

									        ?>
                                </td>
                    		</tr>
                          <?php endwhile; ?>			
                        </tbody>
                      </table>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title">Announcements</h4>
                    </div>
                    <?php
                    $query = $db->query("SELECT * FROM announcements WHERE public = 'true' ORDER BY id DESC", PDO::FETCH_ASSOC);
                    if ($query->rowCount()){
                        foreach( $query as $row ){
                          $string = $row["data"];
                          $stringall=strlen($string);
                          $striphtml = strip_tags($string);
                          $stringnohtml=strlen($striphtml);
                          $stringsize = 500;
                          if($stringnohtml < $stringsize){
                            $limited = $string;
                          }else{
                            $limited = substr($string, 0, $stringsize).'...';
                          }
                          

                          $date_past = date('o-m-d H:i:s', $row["time"]);

                          $ownerid = $row["writer"];

                          $queryy = $db->query("SELECT * FROM accounts WHERE id='$ownerid'", PDO::FETCH_ASSOC);
                          if ($queryy->rowCount()){
                            foreach( $queryy as $cum ){
                              $name = $cum["name"];
                            }
                          }

                          echo '<div class="preview-list">
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail" style="margin-top: 10px;">
                              <div class="preview-icon bg-primary rounded-circle">
                                <i class="fas fa-bullhorn"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-flex flex-grow">
                              <div class="flex-grow">
                                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                  <h6 class="preview-subject"><span style="color:#007bff;">' . $row["title"] . '</span></h6>
                                  <p class="text-muted text-small" style="font-size: 14px;">' . htmlspecialchars($name). ' ' . $date_past . '</p>
                                </div>
                                <p class="text-muted">' . $limited . '</p>
                              </div>
                            </div>
                          </div>
                        </div>';
                        }
                    }else{
                      echo 'There is no more announcement.';
                    }
                    ?>
                    
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
	  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62121438a34c245641273140/1fsb9tvb2';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
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