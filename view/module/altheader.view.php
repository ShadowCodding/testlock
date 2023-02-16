        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="/"><img src="/assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">+ <?php echo @$language["userAddNew"];?></a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Create New</h6>
                  <div class="dropdown-divider"></div>
        
                  <a href="/user/add-script" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1"><?php echo @$language["userAddNewScript"];?></p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="/user/add-ip" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1"><?php echo @$language["userAddNewLicense"];?></p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-1 mb-0 text-center"></p>
                </div>
              </li>

              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <?php

                  $userid = $_SESSION['id'];
                  
                  $query = $db->query("SELECT * FROM logs WHERE owner='$userid'", PDO::FETCH_ASSOC);
                  if ($query->rowCount()){
                    foreach( $query as $row ){
                      if($row["isread"] == "false"){
                        echo '
                      <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                          <div class="preview-icon bg-dark rounded-circle">
                            <i class="mdi ' . $row["icon"] . ' ' . $row["color"] . '"></i>
                          </div>
                        </div>
                        <div class="preview-item-content">
                          <p class="preview-subject mb-1">' . $row["title"] . '</p>
                          <p class="text-muted ellipsis mb-0"> ' . $row["text"] . '</p>
                        </div>
                      </a>
                      <div class="dropdown-divider"></div>';
                      }
                    }
                  }
                  
                  
                  ?>


                  
                  <a href="/logs" style="text-decoration:none;"><p class="p-3 mb-0 text-center">All notifications</p></a>
                </div>
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="
                    <?php
                  
							    $username = $_SESSION["username"];
							    $email = $_SESSION["email"];

							    $email = trim($email);
							    $email = strtolower($email);

                  $user = apiRequest(URL_BASE, false, '');

                  if(isset($user->id)){
                    $discordid = @$user->id;
                    echo 'https://cdn.discordapp.com/avatars/' . $discordid . '/' . $user->avatar . '.webp?size=80';
                  }else{
                    echo 'https://www.gravatar.com/avatar/' . md5($email) . '.jpg';
                  }
                  
							    ?>" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= $_SESSION["name"]?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <p class="p-1 mb-0 text-center"></p>
                  <div class="dropdown-divider"></div>
                  <a href="/logout" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1"><?php echo @$language["userLogout"];?></p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-1 mb-0 text-center"></p>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>