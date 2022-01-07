<!---------------------------------- Account Operation Form  ---------------------------------->
<div class="col-12 col-md-6 bg-dark text-white p-5">
	<h2>Opération</h2>
	<form method="POST">
		<label for="operation_type">
			<?php 
			// Should this below be passed by the controller ??
			require_once "./model/entity/accounts.class.php";
			$accountMngr = new Accounts();
			$accounts = $accountMngr->getAccountsNames();
			?>
			<select id="acc_selector" name="acc_selector">
				<?php
				foreach ($accounts as $act) {
					echo "<option value=" . $act['id'] . ">" . $act['nom'] . "</option>";
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