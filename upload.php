<?php
/* mimaki upload script
 * Copyright © 2018 tyrolyean
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if(!isset($_FILES['print']) || !$_POST['scale']){
        http_response_code(406);
        exit(1);
}
// all variables exist

?>
<!DOCTYPE>
<html lang="en-US">
<head>
        <meta charset="UTF-8">
        <meta name="author" content="tyrolyean">
        <title>UPLOAD</title>
</head>
<body>
        <h1>UPLOADING FILE</h1>
        <p>
<?php
// variables
$printfile="/dev/usb/lp0";
$scale_factor = 1.24023;

echo $_FILES['print']['tmp_name']." writing to file ".$printfile."\n</br>";

echo file_get_contents($_FILES['print']['tmp_name']);

// Check if scaling is needed
if($_POST['scale']){
        echo "scaling by factor ".$scale_factor."\n</br>";
        $output = scale(file_get_contents($_FILES['print']['tmp_name']),
                $scale_factor);
}else{
	$output = $_FILES['print']['tmp_name'];
}

echo "\n<\br>REAL OUTPUT:</br>\n".$output."\n</br>";

echo "\n\n writing file...</br>\n";

file_put_contents($printfile,$output);

echo "DONE</br>\n";

// FUNCTIONS
/*
 * This function scales the hpgl file by a given factor, the code was 
 * transalted from the original python file from @W4RH4WK.
 */
function scale($INPUT, $scale_factor) {
        $OUT = "";
        foreach (explode(';',$INPUT) as $COMMAND) {
                if($COMMAND == ""){
                        continue;
                }else{
                        $i = 1;
                        $exploded = explode(',',$COMMAND);
                        $explodecount = count($exploded);
                        foreach ($exploded as $VALUE) {
                                if(is_numeric($VALUE)){
                                        // Scale integer values by factor
                                        $scaled = round(((int)$VALUE) 
                                                * $scale_factor);
                                        $OUT = $OUT . $scaled;
                                        if($i != $explodecount){
                                                $OUT = $OUT . ',';
                                        }
                                }else{
                                        // Can't sclae non-integer values
                                        $OUT =$OUT . $VALUE;
                                        if($i != $explodecount){
                                                $OUT = $OUT.',';
                                        }
                                }
                                $i++;
                        }

                }
		$OUT =$OUT.";";
        }
        return $OUT;
}
?>
</p>
</body>
</html>

