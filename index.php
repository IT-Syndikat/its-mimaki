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
                        File: <input type="file" id="print" name="print" accept="*.hpgl" required></input></br>
                        Scale (for backwards compatiability): <input type="checkbox" id="scale" name="scale"></input></br>
			<button type="submit">PRINT</button>
		</form>
	</body>
</html>

