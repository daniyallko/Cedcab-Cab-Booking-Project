<?php 
session_start();
include('header.php');
include('adminwrk.php'); 
 ?>
<header>
      <nav  class="navbar navbar-expand-lg">
          <a class="navbar-brand nos" href="index.php">Ced<span class="gree">Cab</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span><i class="fas fa-bars logo text-dark"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                
                  <li class="nav-item rbtn">
                      <a class="btn" href="logout.php">Logout</a>
                  </li>
              </ul>
          </div>
      </nav>
  </header>