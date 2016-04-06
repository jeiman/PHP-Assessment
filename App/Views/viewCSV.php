<?php
require_once 'App/Models/csvImport.php';

$csv = new csvImport( '../assets/example.csv' );
$data = $csv->getData();
print_r( $data );
?>
