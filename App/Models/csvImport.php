<?php

class csvImport {

	private $filename;
	private $header;
	private $delimiter;
	private $length;
	private $parseHeader;


	public function __construct($file_name, $parseHeader=false, $delimiter="\t", $length=100) {

		$this->filename = fopen($file_name, 'r');
    $this->delimiter = $delimiter;
    $this->length = $length;

		if ($this->parseHeader) {
			$this->header = fgetcsv($this->filename, $this->length, $this->delimiter);
		}
	}

	function __destruct() {

		if ($this->filename) {
			fclose($this->filename);

			if(!is_resource($this->filename)){
				echo '<br /><br />file is closed';
			}
		}
	}

	//--------------------------------------------------------------------
	function getDataFromCSV($maxLines=0) {
		//if $maxLines is set to 0, then get all the data
		$data = array();

		if ($maxLines > 0) {
			$lineCount = 0;
		}  else {
			$lineCount = -1; // so loop limit is ignored
		}

		while ($lineCount < $maxLines && ($row = fgetcsv($this->filename, $this->length, $this->delimiter)) !== FALSE) {
			$data[] = $row;

			if ($maxLines > 0) {
				$lineCount++;
			}
		}
        return $data;
    }
}

?>
