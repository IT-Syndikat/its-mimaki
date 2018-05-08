<?php

if(!isset($_FILES['print'])){
        http_response_code(406);
        exit(1);
}
// all variables exist

$printfile="/dev/usb/lp0";

echo $_FILES['print']['tmp_name']." writing to file ".$printfile."\n";
echo file_get_contents($_FILES['print']['tmp_name']);
echo "\n\n printing file...\n";

file_put_contents($printfile,file_get_contents($_FILES['print']['tmp_name']));

echo "DONE";
?>

