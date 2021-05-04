<?php
session_start();
include_once('lib/db.inc.php');

function ierg4210_cat_fetchall() {
	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("SELECT * FROM categories LIMIT 100;");
	if ($q->execute())
		return $q->fetchAll();
}
function ierg4210_cat_insert() {
	// input validation or sanitization
	
	if (!preg_match('/^[\w\-, ]+$/', $_POST['name']))
		throw new Exception("invalid-name");
	// DB manipulation
	global $db;
	$db = ierg4210_DB();
	$q = $db->prepare("INSERT INTO categories (cname) VALUES (:name)");
	return $q->execute(array($_POST['name']));
}

function ierg4210_prod_insert() {
	// DB manipulation
	global $db;
	$db = ierg4210_DB();

	$_POST['catid'] = (int)$_POST['catid'];
	if (!preg_match('/^[\w\-, ]+$/', $_POST['name']))
		throw new Exception("invalid-name");
	$_POST['price'] = (float)$_POST['price'];
	if (!preg_match('/^[\w\-, ]+$/', $_POST['description']))
		throw new Exception("invalid-description");

	$q = $db->prepare("INSERT INTO products VALUES (null,:catid,:name,:price,:desc)");
	$q->execute(array(':catid'=>$_POST['catid'],':name'=>$_POST['name'],':price'=>$_POST['price'],':desc'=>$_POST['description']));

    // The lastInsertId() function returns the pid (primary key) resulted by the last INSERT command
	$lastId = $db->lastInsertId();
    echo "Start upload file<br>";

	// Copy the uploaded file to a folder which can be publicly accessible at incl/img/[pid].jpg
		// Note: Take care of the permission of destination folder (hints: current user is apache)
		if ($_FILES["file"]["error"] == 0
		&& ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/gif" || $_FILES["file"]["type"] == "image/png")
		&& $_FILES["file"]["size"] < 10000000
        ) {
			
		// Note: Take care of the permission of destination folder (hints: current user is apache)
		if (move_uploaded_file($_FILES["file"]["tmp_name"], "incl/image/" . $lastId . ".jpeg")) {
			// redirect back to original page; you may comment it during debug
			header('Location: admin.php');
			exit();
		}
		else{
			header('Content-Type: text/html; charset=utf8');
			echo 'Image file permission problem';
		}
	}
	else{
		// To replace the content-type header which was json and output an error message
		header('Content-Type: text/html; charset=utf-8');
		echo 'Invalid file detected. <br/><a href="javascript:history.back();">Back to admin panel.</a>';
	}
	// Only an invalid file will result in the execution below
	$q = $db->prepare("delete from products where pid=?");
	$q->execute(array($lastId));
	exit();
}



header('Content-Type: application/json');
// input validation
if (empty($_REQUEST['action']) || !preg_match('/^\w+$/', $_REQUEST['action'])) {
	echo json_encode(array('failed'=>'undefined'));
	exit();
}
// The following calls the appropriate function based to the request parameter $_REQUEST['action'],
//   (e.g. When $_REQUEST['action'] is 'cat_insert', the function ierg4210_cat_insert() is called)
// the return values of the functions are then encoded in JSON format and used as output
try {
	if (($returnVal = call_user_func('ierg4210_' . $_REQUEST['action'])) === false) {
		if ($db && $db->errorCode()) 
			error_log(print_r($db->errorInfo(), true));
		echo json_encode(array('failed'=>'1'));
	}
	echo 'while(1);' . json_encode(array('success' => $returnVal));
} catch(PDOException $e) {
	error_log($e->getMessage());
	echo json_encode(array('failed'=>'error-db'));
} catch(Exception $e) {
	echo 'while(1);' . json_encode(array('failed' => $e->getMessage()));
}


?>