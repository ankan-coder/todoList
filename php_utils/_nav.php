<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

  echo '

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TaskBuddy</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


';
} else {
  echo '
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">TaskBuddy</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./signup.php">Sign Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./login.php">Log In</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    ';
}
