<?php

declare(strict_types=1);

const OUTPUT_FILE1_DIR = __DIR__ . '/output1.txt';
const OUTPUT_FILE2_DIR = __DIR__ . '/output2.txt';

function compareFiles(string $file1, string $file2): void
{
    if (!$handleInputFile1 = fopen($file1, 'r')) {
        echo sprintf('Unable to open file1: %s', $file1) . PHP_EOL;
        exit(1);
    }

    if (!$handleInputFile2 = fopen($file2, 'r')) {
        echo sprintf('Unable to open file2: %s', $file2) . PHP_EOL;
        exit(1);
    }

    if (!$handleOutputFile1 = fopen(OUTPUT_FILE1_DIR, 'w')) {
        echo sprintf('Unable to open output file1: %s', OUTPUT_FILE1_DIR) . PHP_EOL;
        exit(1);
    }

    if (!$handleOutputFile2 = fopen(OUTPUT_FILE2_DIR, 'w')) {
        echo sprintf('Unable to open output file2: %s', OUTPUT_FILE2_DIR) . PHP_EOL;
        exit(1);
    }

    $line1 = fgets($handleInputFile1);
    $line2 = fgets($handleInputFile2);

    while ($line1 !== false && $line2 !== false) {
        $line1 = trim($line1);
        $line2 = trim($line2);

        if ($line1 === $line2) {
            $line1 = fgets($handleInputFile1);
            $line2 = fgets($handleInputFile2);
        } elseif ($line1 < $line2) {
            fwrite($handleOutputFile1, $line1 . PHP_EOL);
            $line1 = fgets($handleInputFile1);
        } else {
            fwrite($handleOutputFile2, $line2 . PHP_EOL);
            $line2 = fgets($handleInputFile2);
        }
    }

    while ($line1 !== false) {
        fwrite($handleOutputFile1, trim($line1) . PHP_EOL);
        $line1 = fgets($handleInputFile1);
    }

    while ($line2 !== false) {
        fwrite($handleOutputFile2, trim($line2) . PHP_EOL);
        $line2 = fgets($handleInputFile2);
    }

    fclose($handleInputFile1);
    fclose($handleInputFile2);
    fclose($handleOutputFile1);
    fclose($handleOutputFile2);
}

if ($argc < 3) {
    echo 'You need to set absoulute path of input files, like that: php compare.php <input1.txt> <input2.txt>' . PHP_EOL;
    exit(1);
}

$input1 = $argv[1];
$input2 = $argv[2];

compareFiles($input1, $input2);

echo 'Comparison complete. Check output1.txt and output2.txt in the script directory.' . PHP_EOL;