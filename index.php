<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js"></script>
</head>

<body>
    <nav>
        <a href="">To Do</a>
        <div class="right-align">
            <a href="">Mijn To Do</a>
            <a href="">Login</a>
            <a href="">Nieuwe Lijst</a>
        </div>
    </nav>
    <div class="todo-list">
        <h1 class="todo-list-title">Mijn Todo lijst</h1>
        <ul class="todo-list-checklist">
            <li class="todo-list-checklist-item" onclick="toggleCheck(this)">Enkele todo</li>
        </ul>
    </div>
</body>

</html>