<?php
require_once 'App/Models/csvImport.php';

$csv = new csvImport( 'assets/example.csv' );
$data = $csv->getDataFromCSV();
print_r( $data );

echo '<pre>'.json_encode($data) . '</pre>';

// $fp = fopen('assets/results.json', 'w');
// fwrite($fp, json_encode($data));
// fclose($fp);
?>
