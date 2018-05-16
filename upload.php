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

include "hpgltool.php";

// variables
$printfile="/dev/usb/lp0";

// Why the scaling factor? Because old, very old, too old versions of inkscape
// had the problem that the maximum dpi was hard-coded to 2048 and the mimaki
// needs 2540. DOCUMENTED! and probably deprecated as well as noone uses that
// verion of inkscape anymore
$scale_factor = (2540.0 / 2048.0);

echo $_FILES['print']['tmp_name']." writing to file ".$printfile."\n</br>";

echo file_get_contents($_FILES['print']['tmp_name']);

// Check if scaling is needed
if($_POST['scale']){
        echo "scaling by factor ".$scale_factor."\n</br>";
        echo "This might take a while. please stand by...</br>";
        $output = plain_hpgl(scale_hpgl(
                parse_hpgl(file_get_contents($_FILES['print']['tmp_name'])),
                $scale_factor));
}else{
	$output = file_get_contents($_FILES['print']['tmp_name']);
}

echo "\n<\br>REAL OUTPUT:</br>\n".$output."\n</br>";

echo "\n\n writing file...</br>\n";

file_put_contents($printfile,$output);

echo "DONE</br>\n";

?>
</p>
</body>
</html>

