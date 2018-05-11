<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>MIMAKI ME</title>
		<meta charset="UTF-8">
		<meta name="author" content="tyrolyean">
	</head>
	<body>
		<h1>mimaki.asozial</h1>
		<p>Plot things!</p>
		<form method="POST" action="upload.php" enctype="multipart/form-data">
                        <input type="file" id="print" name="print" accept="*.hpgl" required></input>
                        <input type="check" id="scale" name="scale"></input>
			<button type="submit">PRINT</button>
		</form>
	</body>
</html>

