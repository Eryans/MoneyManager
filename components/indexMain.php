<?php

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

require "data/accounts.php";
require "components/cards.php";
$accounts = get_accounts();

if (!empty($_POST["account"]) && isset($_POST["account"],$_POST["owner"])){
    $accounts[] = [
        "name" => $_POST["account"],
        "number" => "N:0132520024 fr 45",
        "owner" => $_POST["owner"],
        "amount" => 0,
        "last_operation" => "Aucune Opération enregistrée"
      ];
    
}
echo "<ul>";
        foreach($accounts as $content){
            $card = new Card(TRUE,$content["name"],$content["number"],$content["owner"],$content["amount"],$content["last_operation"]);
            echo "<li>";
            $card -> show_card();
            echo "</li>";
        }
echo "</ul>";

?>

<form action="" method="POST">
    <p> Account : </p>  <input type="text" name="account" >
    <p> Owner : </p>  <input type="text" name="owner" >
    <input type="submit" name="submit" value="submit">
</form>

