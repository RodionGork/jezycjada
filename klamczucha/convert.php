<?php

require 'MarkdownInterface.php';
require 'Markdown.php';

if (count($argv) < 3) {
    echo "Usage: php convert.php input.md output.html\n";
}

$mp = new \Michelf\Markdown();

$output = file_get_contents($argv[2]);
$output = substr($output, 0, strpos($output, '<body>') + 6) . "\n";

$text = file_get_contents($argv[1]);

$text = str_replace('--', '&ndash;', $text);

file_put_contents($argv[2], $output . $mp->transform($text) . '</body></html>');
