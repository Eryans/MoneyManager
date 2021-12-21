<?php if (isset($_GET["message"])) {
	echo '<p>' . $_GET["message"] . '</p>';
} ?>
<!---------------------------------- Account Creation Form  ---------------------------------->
<div class="col-12 col-md-6 bg-dark text-white p-5">
	<h2>Création de compte</h2>
	<form class="col-form-label" method="POST">
		<label for="account"> Account :
			<input class="form-control" type="text" name="account" required>
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
			<input class="form-control" type="text" name="owner" required>
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
			<select id="acc_selector" name="acc_selector">
				<?php
				require "./model/get_accounts_names.php";
				?>
			</select>
			<select id="selector" name="operation_type">
				<option value="payment">Virement</option>
				<option value="withdrawal">Retrait</option>
				<option value="deposit">Dépôt</option>
			</select>
		</label>
		<label for="amount">
			Montant :
			<input type="number" name="amount" required>
		</label>
		<label id="op_description" for="op_description">
			Motif:
			<input id="op_desc" type="text" name="op_description">
		</label>
		<label id="rcv_acc_lb" for="receiving_account">
			Compte Receveur :
			<input id="rcv_acc" type="text" name="receiving_account">
		</label>
		<input type="submit" name="operation_submit" value="Send">
	</form>
</div>

<!---------------------------------- JAVASCRIPT ---------------------------------->
<script>
	// Display other input if needed
	let rcv_acc_lb = document.getElementById("rcv_acc_lb");
	let rcv_acc = document.getElementById("rcv_acc_lb");
	let selector = document.getElementById("selector");
	selector.addEventListener("change", () => {
		if (selector.value === "payment") {
			rcv_acc_lb.style.display = "inline-block";
			rcv_acc.setAttribute("required","");
		} else {
			rcv_acc.removeAttribute("required");
			rcv_acc_lb.style.display = "none";
		}
	});
</script>