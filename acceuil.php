

<?php 
  include "./layout/header.php" ;
  if (!isset($_SESSION)){
    session_set_cookie_params(0);
    session_start();
  }
?>

    <section class="justify-content-center d-flex flex-column flex-md-row py-5 gap-5" id="bankAccount">
      <?php
        if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
          require "display/bank_accounts_display.php";
        } else {
          echo "<h2>You must be logged in to acces this page.</h2>";
        } 
      ?>
    </section>

    <script type="text/javascript" src="./js/blocker.js"></script>

<?php include "./layout/footer.php" ?>