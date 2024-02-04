<?php

require 'MarkdownInterface.php';
require 'Markdown.php';

if (count($argv) < 2) {
    echo "Usage: php convert.php input.txt\n";
}

$mp = new \Michelf\Markdown();

$text = file_get_contents($argv[1]);

$title = [];
preg_match('/\[title\]\:.*?\(([^\)]+)\)/', $text, $title);

$text = str_replace('--', '&ndash;', $text);

$body = $mp->transform($text);

$output = "<!doctype html>
<html>
<head>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
  <meta charset=\"utf-8\"/>
  <title>Кламчуха (Лгунья) - М.Мусерович - часть 1 - {$title[1]}</title>
  <link rel=\"stylesheet\" href=\"./common.css\"/>
</head>
<body>
$body
</body>
</html>
";

file_put_contents(str_replace('.txt', '.html', $argv[1]), $output);
