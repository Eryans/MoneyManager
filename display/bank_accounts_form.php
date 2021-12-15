<!---------------------------------- Account Creation Form  ---------------------------------->
<div class="col-12 col-md-6 bg-dark text-white p-5">
	<h2>Création de compte</h2>
  <form class="col-form-label" method="POST">
    <label for="account"> Account :
      <input class="form-control" type="text" name="account" required >
    </label>
    <br>
    <label for="owner"> Owner :
      <label for="prefix">
        <select name="prefix">
          <option value="Mr ">Mr</option>
          <option value="Mlle ">Mlle</option>
          <option value="Mme ">Mme</option>
        </select>
      </label>
      <input class="form-control" type="text" name="owner" required >
    </label>
    <br>
    <label for="account_type">
        <select name="account_type">
          <option value="card">Carte de crédit</option>
          <option value="card">Carte de paiement</option>
          <option value="saving">PEL</option>
          <option value="saving">Livret A</option>
        </select>
    </label>
    <br>
    <input class="btn btn-light" type="submit" name="bk_acc_submit" value="submit">
  </form>
</div>
<!---------------------------------- Account Operation Form  ---------------------------------->
<div class="col-12 col-md-6 bg-dark text-white p-5">
	<h2>Opération</h2>
  <form method="POST">
    <label for="operation_type">
		<select id="acc_selector">
			<?php 
				require "./model/model.php";
				$sql = "SELECT nom FROM compte WHERE clientID = :id";
				$stmt = $db->prepare($sql);
				$stmt->execute(["id" => $_SESSION["userID"]]);
				$accounts = $stmt->fetchAll();
				foreach ($accounts as $act){
					echo "<option value=".$act["nom"].">".$act["nom"]."</option>";
				}
			?>
		</select>
      <select id="selector" name="operation_type">
        <option value="payment">Virement</option>
        <option value="withdrawal">Retrait</option>
        <option value="deposit">Dépôt</option>
      </select>
	</label>
	<label for="amount">
        <input type="text" name="amount">
	</label>
	<label id="rcv_acc_lb"for="receiving_account">
        <input id="rcv_acc" type="text" name="receiving_account">
	</label>
	<input type="submit" name="operation_submit" value="Send">
  </form>
</div>

<!---------------------------- JAVASCRIPT -------------------------------->
<script>
	// Display other input if needed
	let rcv_acc = document.getElementById("rcv_acc");
	let selector = document.getElementById("selector");
	selector.addEventListener("change",() => {
		if (selector.value === "deposit" || selector.value === "withdrawal"){
			rcv_acc.style.display = "none";
		} else {
			rcv_acc.style.display = "inline-block";
		}
	});
	
</script>