          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="
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
                  
							    ?>
                  " alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?= $_SESSION["name"] ?></h5>
                  <span><?php
                  $userid = $_SESSION["id"];
                  $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
                  if ($query->rowCount()){
                      foreach( $query as $row ){
                        $permission = $row["permission"];
                      }
                  }else{
                    $_SESSION = array();
                    if (ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000,
                            $params["path"], $params["domain"],
                            $params["secure"], $params["httponly"]
                        );
                    }
                    session_destroy();
                    header("Location: /"); exit;
                  }

                  if ($permission == 0){
                    echo 'User';
                  }elseif($permission == 1){
                    echo 'Bronze Member';
                  }elseif($permission == 2){
                    echo 'Silver Member';
                  }elseif($permission == 3){
                    echo 'Diamond Member';
                  }elseif($permission == 4){
                    echo 'Premium Member';
                  }elseif($permission == 5){
                    echo 'Admin';
                  }

                  ?></span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="offres" class="dropdown-item preview-item" target="_blank">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-arrow-up-bold-circle text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small"><?php echo @$language["userPlanUpgrade"];?></p>
                  </div>
                </a>
              </div>
            </div>
          </li>

          <?php
          if($permission == 5){?>
          <li class="nav-item nav-category">
            <span class="nav-link">Admin</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/users">
              <span class="menu-icon">
                <i class="fas fa-users"></i>
              </span>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/announcements">
              <span class="menu-icon">
                <i class="fas fa-bullhorn"></i>
              </span>
              <span class="menu-title">Announcement</span>
            </a>
          </li>
          <?php
            }
          ?>
          
          <li class="nav-item nav-category">
            <span class="nav-link"><?php echo @$language["userPages"];?></span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/main">
              <span class="menu-icon">
                <i class="fas fa-home-lg-alt"></i>
              </span>
              <span class="menu-title"><?php echo @$language["userHomepage"];?></span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/user/add-script">
              <span class="menu-icon">
              <i class="fas fa-folder-plus"></i>
              </span>
              <span class="menu-title"><?php echo @$language["userAddNewScript"];?></span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/user/add-ip">
              <span class="menu-icon">
                <i class="fas fa-lock"></i>
              </span>
              <span class="menu-title"><?php echo @$language["userAddNewLicense"];?></span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="/logs">
              <span class="menu-icon">
                <i class="fas fa-archive"></i>
              </span>
              <span class="menu-title"><?php echo @$language["userLogs"];?></span>
            </a>
          </li>