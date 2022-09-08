<?php
//Объявления функций

//функция для рекурсивного поиска файла в папках
//$dir - корневая дериктория поиска
//$filename - имя искомого файла
//$result - массив с результатами поиска
//path - путь к искомому файлу
function search ($dir, $filename, &$result, &$path) {
	//сканируем заданую папку
	$searchResult = scandir($dir);
	print_r($searchResult);
	//перебераем с помощью цикла содержимое корневой папки (оно ввиде массива)
	foreach ($searchResult as $key => $value) {
		//убрали деректории с названием . и ..
		if ($value == '.' || $value == '..') continue; 
		//выводим на экран элементы массива (имя файла, папки)
		echo $value;
		// формируем путь к файлу (папке)
		$dirName = $dir . '/' . $value;
		$result[] = $dirName;
		//результат проверки, является ли элемент массива папкой (если папка, то true, если файл то false)
		$is_dir = is_dir($dirName);
		//выводим на экран результат работы is_dir
		if($is_dir) {
			echo ' (это папка)';
			search ($dirName, $filename, $result, $path);
		}
		if ($value === $filename) {
			echo ' (это искомый файл)';
			//положили путь к найденному файлу
			$path[] = $dirName;
		}
		echo '<br>';
	}
}
//Пошла работа
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

// array
// (
//    [0] => homework7/test_search/test.txt
//    [1] => homework7/test_search/test_recursion/test.txt
// )
// $filterArray = [
//     'homework7/test_search/test.txt',
//     'homework7/test_search/test_recursion/test.txt',
//     'homework7/test_search/test2/test.txt'
// ];
// echo '<br>';
// echo filesize($filterArray[0]);
// echo '<br>';
// echo filesize($filterArray[1]);
// echo '<br>';
// echo filesize($filterArray[2]);
// print_r (array_filter($filterArray, "filesize"));