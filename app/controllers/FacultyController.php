<?php

class FacultyController extends  BaseController {
	
	public function postUploadFile() {
        $file = Input::file('data');
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
        //$res = "";
        $t1 = "Filename<br>";
        $t1 = "<table id='upload' class='table table-striped table-bordered' cellspacing='0' width='100%''>";
        
        for ($row = 1; $row <= $highestRow; $row++) {
            if ($row == 1) {
                $t1 = $t1 . "<thead>";
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
                NULL, TRUE, FALSE);
                foreach($rowData[0] as $k=>$v)
                    if ($v != '')
                        $t1 = $t1 . "<th>" .$v . "</th>";
                        //$res = $res . "Row: ".$row.", Col: ".($k+1)." = ".$v."<br/>";
                $t1 = $t1 . "</thead>";
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
}

?>