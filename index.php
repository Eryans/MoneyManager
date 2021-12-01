<div id="blocker" class="bg-dark text-white position-fixed h-100 w-100"></div>
  <section id="securityInfo" class="bg-light position-fixed container p-0">
    <h2 id = "securityTitle" class="bg-primary col-12 p-2 m-0 ">chargement.</h2>
    <p id = "securityText" class="m-2"> chargement.</p>
    <button id="securityBtn"class="m-2">J'ai compris</button>
  </section>


<?php include "./layout/header.php" ?>

    <section class="row justify-content-center" id="bankAccount">
      <h2>Comptes :</h2>
      <button onclick="createCard()" class="col-3">Testing CreateCard func</button>
    </section>

    <script type="text/javascript" src="./js/bankCard.js"></script>
    <script type="text/javascript" src="./js/blocker.js"></script>

<?php include "./layout/footer.php" ?>