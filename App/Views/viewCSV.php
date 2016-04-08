<?php

class viewCSV {

  public function viewData($data) {
    echo '<pre>';
    print_r( $data );
    $data = json_encode($data);
    return $data;
  }
}

?>
