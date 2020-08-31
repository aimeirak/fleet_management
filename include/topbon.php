<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow align-items-center d-flex justify-content-between"   >
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars text-secondary"></i>
          </button>
            <div class="logo">
              
              <a class="navbar-brand d-none d-sm-inline" href="#">
                  <img src="assets/img/logo.png" style="width:160px; border-radius: 3px;"/>
              </a></div>
          
<?php 
if($_SESSION['role'] == 10 || $_SESSION['role'] == 20){
 //notification     ?>
<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw text-gray-700"></i>
               
                <span class="badge badge-danger badge-counter note">0</span>
              </a>
            
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header text-center" style="background-color:gray;" >
                 You are notified
                </h6>
                <div class="alert-field">              
                 
                  
              
                </div>
                
               
                
              </div>
            </li>
<?php } //end notification  ?>
                
            <div class="profile-place">
            <ul>  
            
              <li class="nav-item dropdown no-arrow">
               
                 <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-sm-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                  <img class="img-profile rounded-circle" src="uploads/default/maleavatar.png">
               
                </a>
                  
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="user.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-700"></i>
                        Profile
                     </a>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-700"></i>
                        Settings
                      </a>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-700"></i>
                        Activity Log
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item"  data-toggle="modal" data-target="#logout">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                      
                     
                    </div>
                  </li>
                </ul>
                </div>
            
          </nav>