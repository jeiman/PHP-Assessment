<?php
// echo '<pre>';
// require_once 'App/Views/viewCSV.php';


$myfile = fopen("example.csv", "a+") or die("Unable to open file!");
$txt = "John Doe,39403904,San Jose 21\n";
fwrite($myfile, $txt);
$txt = "Jane Doe,4938928,San Fran 23\n";
fwrite($myfile, $txt);
fclose($myfile);

// $file="assets/example.csv";
// $csv= file_get_contents($file);
// $array = array_map("str_getcsv", explode("\n", $csv));
// $json = json_encode($array);
// echo '<pre>';
// print_r($json);

?>
