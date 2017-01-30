<?php

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], '../dir/'.$_FILES['upl']['name'])){
		echo '{"status":"success","img1":"'.$_FILES['upl']['tmp_name'][0].'","img1":"'.$_FILES['upl']['tmp_name'][1].'","img1":"'.$_FILES['upl']['tmp_name'][2].'","img1":"'.$_FILES['upl']['tmp_name'][3].'"}';
		exit;
	}
}



echo '{"status":"error"}';
exit;