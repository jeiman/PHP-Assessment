<?php

// public function __autoload($class) {
//   require_once 'App/'.$class.'.php';
// }


$myfile = fopen("assets/example.csv", "a+") or die("Unable to open file!");
$txt = "Singam Jeya,49328498234892,London UK\n";
fwrite($myfile, $txt);
//$txt = "Jane Doe,4938928,San Fran 23\n";
//fwrite($myfile, $txt);
fclose($myfile);

echo '<pre>';
require_once 'App/Views/viewCSV.php';

// $file="assets/example.csv";
// $csv= file_get_contents($file);
// $array = array_map("str_getcsv", explode("\n", $csv));
// $json = json_encode($array);
// echo '<pre>';
// print_r($json);

?>
