<?php
if (!isset($_SESSION['user'])) {
  header('Location:../login.php');
}else{
  $user = unserialize($_SESSION['user']);
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 36000)) {
  // last request was more than 30 minutes ago
  session_unset();     // unset $_SESSION variable for the run-time
  session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../index.php">SICTEEBEY</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="../imports/php/auxiliarFunctions/logoutAction.php">Cerrar Sesi&oacute;n</a>
        </li>
      </ul>
    </div><!--/.navbar-collapse -->
  </div>
</nav>
