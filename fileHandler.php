<?php
function fileHandler($filePath) {
    // Open the CSV file for reading
    $handle = fopen($filePath, 'r'); // mode r --> Read only

    if ($handle) { //if file opened success
        while (($data = fgetcsv($handle)) !== false) { // $data is array with values from csv
            $wordsToPlay[] = $data[0];
        }
        return $wordsToPlay;
    } else {
        throw new Exception("Unable to open file"); //throws exception if fifle cannot open
    }
}//End filehandler function

