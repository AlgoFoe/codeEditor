<?php 
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {  
  $loggedin = true;
} else {
  $loggedin = false;
}
?>
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyLogin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" <?php echo ($loggedin ? 'href="http://127.0.0.1:5500/"' : ''); ?>>Home</a>
        </li>
        <?php if (!$loggedin) { ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/webpage/login_sys/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/webpage/login_sys/signup.php">Signup</a>
          </li>
        <?php } ?>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
