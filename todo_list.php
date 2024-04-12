<?php
// Verbinden met de database
require_once("php classes/account.php");

$database_config = json_decode(file_get_contents("database_config.json"));
$database = new Database($database_config);
$account = new Account($database);
session_start();
if (isset($_SESSION["account"])) {
    $account->import($_SESSION["account"]);
}

$conn = new mysqli($servername, $username, $password, $dbname);

// Check de verbinding
if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}

// Aanmaken van een nieuwe to-do lijst
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["list_title"])) {
    $user_id = $_SESSION['user_id']; // Gebruikers-ID van ingelogde gebruiker
    $list_title = $_POST["list_title"];
    
    $sql = "INSERT INTO todo_lists (user_id, list_title) VALUES ('$user_id', '$list_title')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nieuwe to-do lijst aangemaakt!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Bewerken van de titel van de to-do lijst
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_list_title"])) {
    $list_id = $_POST["list_id"];
    $list_title = $_POST["edit_list_title"];
    
    $sql = "UPDATE todo_lists SET list_title='$list_title' WHERE id='$list_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Titel van to-do lijst bijgewerkt!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Verwijderen van de to-do lijst
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_list"])) {
    $list_id = $_POST["list_id"];
    
    $sql = "DELETE FROM todo_lists WHERE id='$list_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "To-do lijst verwijderd!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>