<?php
/* 
$servername = "localhost";
$username = "jules";
$password = "03011595";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();
 */
require "data/accounts.php";
require "components/cards.php";
$accounts = get_accounts();

if (!empty($_POST["account"]) && isset($_POST["account"],$_POST["owner"])){
    $accounts[] = [
        "name" => $_POST["account"],
        "number" => "N:0" . rand(100000000, 999999999) ." fr 45",
        "owner" => $_POST["prefix"] . $_POST["owner"],
        "amount" => 0,
        "last_operation" => "Aucune Opération enregistrée"
      ];
    
}
echo "<div>";
echo "<h2>Comptes :</h2>";
echo "<ul class='list-group'>";
        foreach($accounts as $content){
            $card = new Card(TRUE, $content["name"],$content["number"],$content["owner"],$content["amount"],$content["last_operation"]);
            echo "<li >";
            $card -> show_card();
            echo "</li>";
        }
echo "</ul>";
echo "</div>";

?>

<div class="col-12 col-md-6 bg-dark text-white p-5">
  <form class="col-form-label"action="" method="POST">
      <label for="account"> Account :
        <input class="form-control" type="text" name="account" >
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
          <input class="form-control" type="text" name="owner" >
      </label>
      <input class="btn btn-light" type="submit" name="submit" value="submit">
  </form>
</div>

