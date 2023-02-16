<?php

include "lang.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Logs - <?php echo @$language["SystemName"];?></title>
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
                    <h4 class="card-title"><?php echo @$language["userSystemLogs"];?></h4>
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
                                table3.innerHTML = table3.innerHTML + '<tr><td>' + value["id"] + '</td><td>' + value["ip"] + '</td><td>' + status + '</td><td>' + value["variables"] + '</td><td>' + value["deadline"] + '</td><td><button id="' + value["id"] + '" value="' + modalid + '" class="btn btn-danger delete-row-license"><?php echo @$language["userDelete"];?></a></td></tr>';
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
                              <th>Category</th>
                              <th>Title</th>
                              <th>Text</th>
                              <th>Time</th>
                              <th>Settings</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                              $username = $_SESSION["id"];
                              $query = $db->query("SELECT * FROM logs WHERE owner='$username'",PDO::FETCH_ASSOC);
                              while ($row = $query->fetch()):
                          ?>
                            <tr>
                                <td><?php echo '<i style="font-size:16px;" class="mdi ' . $row["icon"] . ' ' . $row["color"] . '"></i>' ?></td>
                                <td><?php echo htmlspecialchars($row['title']) ?></td>
                                <td><?php echo htmlspecialchars($row['text']) ?></td>
                                <td><?php echo htmlspecialchars($row['date']) ?></td>
                                <td>
                                    <?php
                                        $rowid =  $row["id"];
                                        $type = $row["type"];

                                        if($type == "license"){
                                          $arraydata = json_decode($row['data']);
                                          $key = $arraydata[0];
                                          $servername = $arraydata[1];
                                          $name = $arraydata[6];
                                          $steamapikey = $arraydata[2];
                                          $rcon = $arraydata[3];
                                          $tags = $arraydata[4];
                                          $serverkey = $arraydata[5];
                                          $scriptid = $arraydata[7];
                                          $ip = $arraydata[8];

                                          echo '<button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#exampleModal' . $row["id"] . '">
                                            Details
                                          </button><a class="btn btn-danger ml-3" href="/api/delete/log/' . $row['id'] . '">Delete</a>

                                          <!-- Modal -->
                                          <div class="modal fade" id="exampleModal' . htmlspecialchars($row['id']) . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="max-width: 800px !important;">
                                              <div class="modal-content" style="background-color:#191c24;">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">' . $arraydata[8] . ' - ' . htmlspecialchars($row['title']) . '</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body" style="text-align:left;">
                                                  Server Name: <b>' . $servername . '</b><br><br>
                                                  Server IP: <b>' . $ip . '</b><br><br>
                                                  Script: <b>' . $name . '</b><br><br>
                                                  RCON Password: <b>' . $rcon . '</b><br><br>
                                                  Steam API Key: <b>' . $steamapikey . '</b><br><br>
                                                  Server Tags: <b>' . $tags . '</b><br><br>
                                                  Server Key: <b>' . $serverkey . '</b><br><br>
                                                </div>

                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">' . $language["userClose"] . '</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>';
                                        }elseif($type == "non-license"){
                                          echo '<a class="btn btn-danger ml-3" href="/api/delete/log/' . $row['id'] . '">Delete</a>';
                                        }
                                        
                                        

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