<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist</title>
    <link rel="stylesheet" href="style.css">
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

    <div class="lijst">    
    <h1 class="titellijst">Mijn Checklist</h1>

    <!-- Checklist -->
    <ul class="checklist">
        <li class="checklist-item" onclick="toggleCheck(this)">pak de laptop</li>
        <li class="checklist-item" onclick="toggleCheck(this)">open de laptop</li>
        <li class="checklist-item" onclick="toggleCheck(this)">druk op de aanknop</li>
        <li class="checklist-item" onclick="toggleCheck(this)">kijk of de laptop opstart</li>
    </ul>
</div>
<div class="lijst">    
    <h1 class="titellijst">Mijn Checklist</h1>

    <!-- Checklist -->
    <ul class="checklist">
        <li class="checklist-item" onclick="toggleCheck(this)">punt 1</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 2</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 3</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 4</li>
    </ul>
</div>
<div class="lijst">    
    <h1 class="titellijst">Mijn Checklist</h1>

    <!-- Checklist -->
    <ul class="checklist">
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 1</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 2</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 3</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 4</li>
    </ul>
</div>
<div class="lijst">    
    <h1 class="titellijst">Mijn Checklist</h1>

    <!-- Checklist -->
    <ul class="checklist">
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 1</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 2</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 3</li>
        <li class="checklist-item" onclick="toggleCheck(this)">Punt 4</li>
    </ul>
</div>

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