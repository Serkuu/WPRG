<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operacje na ciągach znaków</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: whitesmoke;
            color: #333;
        }
        .container {
            width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: lightgray;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input[type="text"], select, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: dodgerblue;
            color: whitesmoke;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: lightgray;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Operacje na ciągach znaków</h1>
    <form method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
        <label for="inputText">Wprowadź tekst:</label>
        <input type="text" id="inputText" name="inputText" value="<?= isset($_POST['inputText'])?>">

        <label for="operation">Wybierz operację:</label>
        <select id="operation" name="operation">
            <option value="reverse" <?= isset($_POST['operation']) && $_POST['operation'] == 'reverse'?>>Odwrócenie ciągu znaków</option>
            <option value="uppercase" <?= isset($_POST['operation']) && $_POST['operation'] == 'uppercase'?>>Wielkie litery</option>
            <option value="lowercase" <?= isset($_POST['operation']) && $_POST['operation'] == 'lowercase'?>>Małe litery</option>
            <option value="count" <?= isset($_POST['operation']) && $_POST['operation'] == 'count'?>>Liczenie liczby znaków</option>
            <option value="trim" <?= isset($_POST['operation']) && $_POST['operation'] == 'trim'?>>Usuwanie białych znaków</option>
        </select>

        <button type="submit">Wykonaj</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputText = $_POST['inputText'];
        $operation = $_POST['operation'];
        $result = '';
        $error = '';

        if (empty($inputText)) {
            $error = "Pole tekstowe nie może być puste!";
        }
        if (!$error) {
            switch ($operation) {
                case "reverse":
                    $result = strrev($inputText);
                    break;
                case "uppercase":
                    $result = strtoupper($inputText);
                    break;
                case "lowercase":
                    $result = strtolower($inputText);
                    break;
                case "count":
                    $result = strlen($inputText);
                    break;
                case "trim":
                    $result = trim($inputText);
                    break;
                default:
                    $error = "Nieprawidłowa operacja.";
            }
        }
        if ($error) {
            echo "<p class='error'>$error</p>";
        } else {
            echo "<div class='result'><strong>Wynik:</strong> $result</div>";
        }
    }
    ?>
</div>
</body>
</html>
