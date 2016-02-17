<?php

function array_of_assoc_arrays_to_csv($filehandle, $array_of_assoc_arrays, $headers) {
    if ($filehandle) {
        // make the first line of the csv contain the headers
        fputcsv($filehandle, $headers);

        foreach($array_of_assoc_arrays as $assoc_array) {
            fputcsv($filehandle, $assoc_array);
        }
        fclose($filehandle);
    } else {
        trigger_error("Incorrect file handle.");
    }
}

function mysql_result_to_csv($filehandle, $mysql_result) {
    if ($filehandle) {
        // make the first line of the csv be the field names from the database
        $fields_array = array_map(function($field_object) { return $field_object->name; }, $mysql_result->fetch_fields());
        fputcsv($filehandle, $fields_array);

        while ($row = $mysql_result->fetch_array(MYSQLI_NUM)) {
            fputcsv($filehandle, $row);
        }
        fclose($filehandle);
    } else {
        trigger_error("Incorrect file handle.");
    }
}

?>
