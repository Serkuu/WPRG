<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obsługa katalogów</title>
</head>
<body>
<form method="POST">
    <label for="path">Ścieżka:</label><br>
    <input type="text" id="path" name="path" required><br><br>

    <label for="directory">Nazwa katalogu:</label><br>
    <input type="text" id="directory" name="directory" required><br><br>

    <label for="action">Wybierz operację:</label><br>
    <select id="action" name="action">
        <option value="read">Odczytaj katalog</option>
        <option value="create">Stwórz katalog</option>
        <option value="delete">Usuń katalog</option>
    </select><br><br>

    <button type="submit">Wykonaj</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = $_POST['path'];
    $directory = $_POST['directory'];
    $action = $_POST['action'];

    function manageDirectory($path, $directory, $action = 'read') {
        if (substr($path, -1) !== '/') {
            $path .= '/';
        }

        $fullPath = $path . $directory;

        switch ($action) {
            case 'read':
                if (is_dir($fullPath)) {
                    $elements = scandir($fullPath);
                    if ($elements !== false) {
                        return "Zawartość katalogu '$fullPath':<br>" . implode('<br>', array_diff($elements, ['.', '..']));
                    } else {
                        return "Nie udało się odczytać zawartości katalogu.";
                    }
                } else {
                    return "Katalog nie istnieje.";
                }

            case 'create':
                if (is_dir($fullPath)) {
                    return "Katalog już istnieje.";
                }
                if (mkdir($fullPath, 0755, true)) {
                    return "Katalog został pomyślnie utworzony.";
                } else {
                    return "Nie udało się utworzyć katalogu.";
                }

            case 'delete':
                if (is_dir($fullPath)) {
                    $elements = array_diff(scandir($fullPath), ['.', '..']);
                    if (empty($elements)) {
                        if (rmdir($fullPath)) {
                            return "Katalog został pomyślnie usunięty.";
                        } else {
                            return "Nie udało się usunąć katalogu.";
                        }
                    } else {
                        return "Katalog nie jest pusty.";
                    }
                } else {
                    return "Katalog nie istnieje.";
                }

            default:
                return "Nieznana operacja.";
        }
    }

    echo '<p>' . manageDirectory($path, $directory, $action) . '</p>';
}
?>
</body>
</html>
