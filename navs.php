<header>
    <nav  class="navbar navbar-expand-lg">
        <a class="navbar-brand nos" href="indexlog.php">Ced<span class="gree">Cab</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-bars logo text-dark"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-5">
                    <p class="mt-1">Welcome <?php echo $_SESSION['userdata']['username'] ?></p>
                </li>
                <li class="nav-item rbtn ">
                    <a class="btn" href="dash.php">Dashboard</a>
                </li>
                <li class="nav-item rbtn ">
                    <a class="btn" href="indexlog.php">Book Now</a>
                </li>
                <li class="nav-item rbtn">
                    <a class="btn" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>