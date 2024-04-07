<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoManager</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js"></script>
</head>

<body>
    <nav>
        <div id="nav-left">
            <a href="">To Do</a>
        </div>
        <div id="nav-right">
            <a href="">Mijn To Do</a>
            <a href="">Login</a>
            <a href="">Nieuwe Lijst</a>
        </div>
    </nav>
    <main>
        <div id="about">
            <h1>Over TodoManager</h1>
            <p>
                TodoManager is een handige tool waarmee je je eigen todo lijsten kunt maken en delen met anderen.
            </p>
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