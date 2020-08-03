<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow align-items-center d-flex justify-content-between"   >
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars text-secondary"></i>
          </button>
            <div class="logo">
              
              <a class="navbar-brand d-none d-sm-inline" href="#">
                  <img src="assets/img/logo.png" style="width:160px; border-radius: 3px;"/>
              </a></div>
          

                
            <div class="profile-place">
            <ul>  
              <li class="nav-item dropdown no-arrow">
                 <!-- avatar -->
                 <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-sm-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                  <img class="img-profile rounded-circle" src="uploads/default/maleavatar.png">
               
                </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <span class="dropdown-item" id="profile1">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-700"></i>
                        Profile
                      </span>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-700"></i>
                        Settings
                      </a>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-700"></i>
                        Activity Log
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logout">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                      
                     
                    </div>
                  </li>
                </ul>
                </div>
            
          </nav>