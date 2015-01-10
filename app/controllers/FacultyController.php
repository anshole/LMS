<?php

class FacultyController extends  BaseController {

    /*
    * All POST requests first come here.
    */ 
    public function postRequestHandler() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["ext"])) {
                $this->postUploadFile();
            } else if (isset($_POST["sheetid"])) {
                $this->readStoredFile();
            }
        }
    }

	/*
	* Function for file upload
	*/
	public function postUploadFile() {

        $file = Input::file('data');

        $sheet_name = $file->getClientOriginalName();
        $sheet_creator = Auth::user()->id;

        // Store data in sheet_info table
        $sheet_info = new Sheet_info;
        $sheet_info->sheet_name = $sheet_name;
        $sheet_info->sheet_creator = $sheet_creator;
        $sheet_info->save();
       

        $destinationPath = public_path().'/uploads';
        $filename        = str_random(6) . '_' . $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        
        //echo "File Uploaded: " . $filename . " at " . $destinationPath . " - " . $uploadSuccess;

        $inputFileName =  $destinationPath . '/' . $filename; //public_path() . '/files/index.xlsx';

        if (!file_exists($inputFileName)) {
            print("[ERROR] File not found ----------" . $inputFileName);
            exit("File not found." . EOL);
        } 

        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->canRead($inputFileName);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file');
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);

        //$res = "";
        $t1 = "<br><br>Filename: " . $sheet_name . "<br>";
        $t1 = $t1 . "<table id='upload' class='table table-condensed table-bordered' cellspacing='0' width='100%'>";
        

        $tag = "<thead>";
        $endtag = "</thead>";
        for ($row = 1; $row <= $highestRow; $row++) {

            // Store data in databse
            for($col = 0; $col < $highestColNumber; $col++) {
                
                if ($objPHPExcel->getSheet(0)->getCellByColumnAndRow($col, $row)->getValue() != "") {
                     
                     // Store data in Sheet_cell
                     $sheet_cells = new Sheet_cells;
                     $sheet_cells->sheet_id = $sheet_info->id;
                     $sheet_cells->cell_row = $row;
                     $sheet_cells->cell_column = $col;
                     $sheet_cells->cell_content = $objPHPExcel->getSheet(0)->getCellByColumnAndRow($col, $row)->getValue();
                     $sheet_cells->save();

                }
            }

            if ($row == 1) {
            	for ($q = 0; $q < 2; $q++) {
            		if ($q == 1) {
            			$tag = "<tfoot>";
            			$endtag = "</tfoot>";
                    }

                	$t1 = $t1 . $tag;
	                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
	                NULL, TRUE, FALSE);
	                foreach($rowData[0] as $k=>$v)
	                    if ($v != '')
	                        $t1 = $t1 . "<th>" .$v . "</th>";
                             
	                        //$res = $res . "Row: ".$row.", Col: ".($k+1)." = ".$v."<br/>";
	                $t1 = $t1 . $endtag;
		    	
            	}
            
            }

            $t1 = $t1 . "<tr>";
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
            NULL, TRUE, FALSE);
            
            foreach($rowData[0] as $k=>$v)
                if ($v != '')
                    $t1 = $t1 . "<td>" .$v . "</td>";

                    //$res = $res . "Row: ".$row.", Col: ".($k+1)." = ".$v."<br/>";
            $t1 = $t1 . "</tr>";
        }
        $t1 = $t1 . "</tbody></table>";
        echo $t1;
    }

    /*
    * Function to get a stored file (spreadsheet) from database.
    */
    public function readStoredFile() {
        // For now, just get the latest stored spreadsheet
        $sheet = Sheet_info::getLastUploadedSheet();
        $sheet_id = $sheet->id;

        // TODO: Send and display the sheet to requesting page.

        echo "readStoredFile(): Last uploaded sheet id is " . $sheet_id;
    }
}
?>