<?php

$file_path = 'links.txt';

$file_contents = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$links = [];

foreach ($file_contents as $line) {
    list($url, $description) = explode(';', $line, 2);
    $links[] = [
        'url' => trim($url),
        'description' => trim($description),
    ];
}

echo "<ul>\n";
foreach ($links as $link) {
    echo '<li><a href="' . htmlspecialchars($link['url']) . '" target="_blank">' . htmlspecialchars($link['description']) . "</a></li>\n";
}
echo "</ul>\n";
