<?php
if (file_exists("docs/" . $_FILES["upload"]["name"])) {
	echo $_FILES["upload"]["name"] . " already exists please choose another image.";
} else {
	move_uploaded_file($_FILES["upload"]["tmp_name"], "docs/" . $_FILES["upload"]["name"]);
	echo "Stored in: " . "docs/" . $_FILES["upload"]["name"];
}
?>