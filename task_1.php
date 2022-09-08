<?php

function search ($dir, $filename, &$result, &$path) {
    $searchResult = scandir($dir);
    print_r($searchResult);
    foreach ($searchResult as $key => $value) {
        if ($value == '.' || $value == '..') continue; 
        echo $value;
        $dirName = $dir . '/' . $value;
        $result[] = $dirName;
        $is_dir = is_dir($dirName);
        if($is_dir) {
            echo ' (это папка)';
            search ($dirName, $filename, $result, $path);
        }
        if ($value === $filename) {
            echo ' (это искомый файл)';
            $path[] = $dirName;
        }
        echo '<br>';
    }
}
echo '<pre>';
$searchRoot = 'homework7/test_search';
$searchName = 'test.txt';
$searchNamePath = [];
$searchResult = [];
search ($searchRoot, $searchName, $searchResult, $searchNamePath);
if ($searchNamePath) {
    print_r($searchNamePath);
    print_r (array_filter($searchNamePath, "filesize"));
} else {
    echo 'файл не найден';
}

