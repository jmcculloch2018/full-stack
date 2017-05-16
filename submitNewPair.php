<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=full-stack", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$first = $_GET['first'];
	$last = $_GET['last'];
	$word = $_GET['word'];

	$sql = "SELECT * FROM teachers WHERE firstName = \"" . $first . "\" AND lastName = \"" . $last . "\";";
	$teacherRows = $conn->query($sql)->fetchAll();

	$teacherId;
	if (count($teacherRows) > 0) {
		$teacherId = $teacherRows[0]['id'];
	} else {
		$sql = "INSERT INTO teachers (firstName, lastName) VALUES (\"" . $first . "\", \"" . $last . "\")";
		$conn->query($sql);
		$teacherId = $conn->lastInsertId();
	}

	$sql = "SELECT * FROM words WHERE word = \"" . $word . "\";";
	$wordRows = $conn->query($sql)->fetchAll();

	$wordId;
	if (count($wordRows) > 0) {
		$wordId =$wordRows[0]['id'];
	} else {
		$sql = "INSERT INTO words (word) VALUES (\"" . $word . "\")";
		$conn->query($sql);
		$wordId = $conn->lastInsertId();
	}

	$sql = "SELECT * FROM teacherToWord WHERE teacherId = " . $teacherId . " AND wordId = " . $wordId;
	$teacherToWordRows = $conn->query($sql)->fetchAll();

	if (count($teacherToWordRows) == 0) {
		$sql = "INSERT INTO teacherToWord (wordId, teacherId, count) VALUES (\"" . $wordId . "\", \"" . $teacherId . "\", 0)";
		$conn->query($sql);
	}

	$sql = "SELECT count FROM teacherToWord WHERE teacherId = " . $teacherId . " AND wordId = " . $wordId;
	$count = $conn->query($sql)->fetchAll()[0]['count'];

	$sql = "UPDATE teacherToWord SET count = " . ($count + 1) . " WHERE teacherId = " . $teacherId . " AND wordId = " . $wordId;
	$conn->query($sql);

	

	print $first . " " . $last . " is associated with " . $word . " " . ($count + 1) . " times.";
    
	
} catch(PDOException $e) {
}

?>