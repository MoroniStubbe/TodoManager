<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist</title>
    <style>
        nav {
            background-color: blue;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: red;
            color: black;
        }

        /* Stijl voor rechts uitgelijnde links */
        .right-align {
            float: right;
        }

        .checked {
            background-color: #c7e6c7;
            color: #4CAF50;
            text-decoration: line-through;
        }

        .checklist-item {
            list-style-type: none;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .test {
            background-color: blue
            hight: 110px;
            wi
        }
    </style>
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

    <h1>Mijn Checklist</h1>

    <!-- Checklist -->
    <ul id="checklist">
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 1</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 2</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 3</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 4</li>
    </ul>

    <div class=test>

    </div>

    <!-- JavaScript -->
    <script>
        // Functie om item aan/uit te vinken
        function toggleCheck(item) {
            item.classList.toggle("checked");
        }
    </script>
</body>
</html>