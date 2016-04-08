<?php

class AppController {

  private $uri;
  private $csvFilePath = 'assets/example.csv'; //This can be changed according to the CSV file provided inside the /assets folder
  private $csvTmpFilePath = 'assets/example.tmp';

  public function create() {

    if ( file_exists($this->csvFilePath) ) { //File exists validaiton

      $myFile = fopen($this->csvFilePath, "a+");
      $createField = $_POST['create']."\n";
      fwrite($myFile, $createField);
      fclose($myFile);

    } else {
      echo 'File doesnt exsits to add data';
    }

  }

  public function read() {

    $csv = new csvImport( $this->csvFilePath );
    $data = $csv->getDataFromCSV();

    if ( isset($_GET['read']) ) {
      if ( isset($data[$_GET['read']]) ) {
        $data = $data[$_GET['read']];
      }
    }

    $view = new viewCSV();
    return $view->viewData($data);

  }

  public function update() {

    $request_body = file_get_contents('php://input');
    $request_body = json_decode($request_body);
    print_r($request_body);

    if ( file_exists($this->csvFilePath) ) { //File exists validation

      $myFile = fopen($this->csvFilePath, "r");
      $writing = fopen($this->csvTmpFilePath, 'w');

      $updateField = $request_body->update ."\n";
      $updateID = $request_body->id;
      $lineNo = 0;
      $replaced = false;

      while (!feof($myFile)) {
        $line = fgets($myFile);

        if ( $lineNo == $updateID ) {
          echo $line;
          $line = $updateField;
          $replaced = true;

        }

        fputs($writing, $line);
        $lineNo++;
      }
      fclose($myFile);
      fclose($writing);

      if ($replaced) {
        rename($this->csvTmpFilePath, $this->csvFilePath);
      } else {
        unlink($this->csvTmpFilePath);
      }

    } else {
      echo 'File doesnt exist to update data';
    }
  }

  public function delete() {

    $request_body = file_get_contents('php://input');
    $request_body = json_decode($request_body);
    print_r($request_body);

    if ( file_exists($this->csvFilePath) ) { //File exists validation

      $myFile = fopen($this->csvFilePath, "r");
      $writing = fopen($this->csvTmpFilePath, 'w');

      $deleteID = $request_body->id;
      $lineNo = 0;
      $replaced = false;

      while (!feof($myFile)) {
        $line = fgets($myFile);

        if ( $lineNo != $deleteID ) {
          fputs($writing, $line);
          echo $line;
        } else {
          $replaced = true;
        }

        $lineNo++;
      }
      fclose($myFile);
      fclose($writing);

      if ($replaced) {
        rename($this->csvTmpFilePath, $this->csvFilePath);
      } else {
        unlink($this->csvTmpFilePath);
      }

    } else {
      echo 'File doesnt exist to delete data';
    }
  }
}
?>
