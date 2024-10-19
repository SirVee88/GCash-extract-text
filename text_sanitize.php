<?php
// GLOB_CASE will deal with .TxT .TXT .txT 
$files = glob('uploads/*.txt', GLOB_CASE);

foreach ($files as $file) {
    // We will not READ empty lines, effectively IGNORING them
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $key => $line) {
        if (strpos($line, 'Total Amount') === 0) {
            $lines[$key] = str_replace("0 0", "00", $line);
            $lines[$key] = str_replace(" e ", "", $lines[$key]);
        }
    }

    // Remove empty lines using array_filter()
    $lines = array_filter($lines, 'trim'); 

    $text = implode(PHP_EOL, $lines);

    file_put_contents($file, $text);
}
?>
