<?php
	
if ($_FILES['uploadedfile']['name'] != '') {
	$dir = dirname(__FILE__).'/'.$_FILES['uploadedfile']['name'].'_DIR';
	if(is_dir($dir)) {
		$cmd = "rm -rf $dir";
		`$cmd`;
	}
	mkdir($dir, 0777);
	chmod($dir, 0777);
	$masterFile = $dir.'/AAAAA_'.$_FILES['uploadedfile']['name'];
	move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $masterFile);
	for($i=0; $i<=1111; $i++) {
		$x = mt_rand(0, 15000-1920);
		$image = new Imagick($masterFile);
		$image->cropImage(1600, 463, $x, 0);
		$image->writeImage($dir.'/'.$x.'_'.$_FILES['uploadedfile']['name']);
	}
}
else {
	echo '
		<form enctype="multipart/form-data" action="qingming.php" method="POST">
			<input type="hidden" />
			Choose a file to upload: <input name="uploadedfile" type="file" />
			<input type="submit" value="Upload File" />
		</form>';
}

echo '<hr />';
echo '<a href="./">Go back to directories…</a>';

?>
