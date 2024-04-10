<?php
require_once("php classes/account.php");

$database_config = json_decode(file_get_contents("database_config.json"));
$database = new Database($database_config);
$account = new Account($database);
session_start();
if (isset($_SESSION["account"])) {
    $account->import($_SESSION["account"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoManager</title>
    <link rel="stylesheet" href="index.css">
    <script src="js classes/api.js"></script>
    <script src="js classes/account.js"></script>
    <script src="index.js"></script>
</head>

<body>
    <nav>
        <div id="nav-right">
            <?php
            if ($account->is_logged_in()) {
                echo '
                    <a href="?create_todo_list">
                        <div>Nieuwe Lijst</div>
                    </a>
                    <a href="account.php">
                        <div>Mijn Account</div>
                    </a>
                    <a id="log_out">
                        <div>Uitloggen</div>
                    </a>';
            } else {
                echo '
                    <a href="login.php">
                        <div>Inloggen</div>
                    </a>';
            }
            ?>
        </div>
    </nav>
    <main>
        <div id="about">
            <h1>Over TodoManager</h1>
            <div id="about-text-container">
                <div id="about-text">
                    <p>
                        TodoManager is een handige tool waarmee je je eigen todo lijsten kunt maken en delen met anderen.
                    </p>
                </div>
            </div>
        </div>
        <div id="todo-list">
            <h1 id="todo-list-title">$todo_lists[$currentTodo->id]->title</h1>
            <ul id="todos">
                <li class="todo" onclick="toggleCheck(this)">
                    <div>$todos[0]->text</div>
                </li>
                <li class="todo" onclick="toggleCheck(this)">
                    <div>$todos[1]->text</div>
                </li>
            </ul>
        </div>
        <div id="todo-lists">
            <h1>Mijn todo lijsten</h1>
            <ul>
                <li id="todo-list-1"><a href="">$todo_lists[0]->title</a></li>
                <li id="todo-list-2"><a href="">$todo_lists[1]->title</a></li>
            </ul>
        </div>
    </main>
</body>

</html>