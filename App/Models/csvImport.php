<?php

class csvImport {

	private $filename;
	private $parse_header;
  private $header;
  private $delimiter;
  private $length;


	public function __construct($file_name, $parse_header=false, $delimiter="\t", $length=100) {

		$this->filename = fopen($file_name, 'r+');
		$this->parse_header = $parse_header;
    $this->delimiter = $delimiter;
    $this->length = $length;

		if ($this->parse_header) {
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
	function getData($maxLines=0) {
		//if $maxLines is set to 0, then get all the data
		$data = array();

if ($maxLines > 0)
		$lineCount = 0;
        else
            $lineCount = -1; // so loop limit is ignored

				while ($lineCount < $maxLines && ($row = fgetcsv($this->filename, $this->length, $this->delimiter)) !== FALSE) {
            if ($this->parse_header) {
                foreach ($this->header as $i => $heading_i) {
                    $newRow[$heading_i] = $row[$i];
                }
                $data[] = $newRow;
            }
            else
            {
                $data[] = $row;
            }

            if ($maxLines > 0)
                $lineCount++;
        }
        return $data;
    }

	public function updateRecord() {

	}

	public function deleteRecord() {

	}

}

?>
