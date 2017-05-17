<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=full-stack", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$word = $_GET['word'];

	$sql = "SELECT * FROM words WHERE word = \"" . $word . "\";";
	$wordRows = $conn->query($sql)->fetchAll();

	if (count($wordRows) > 0) {
		$wordId = $wordRows[0]['id'];
		print $word . " is associated with: <br>";
		print "<table>";
		$sql = "SELECT * FROM teacherToWord WHERE wordId = " . $wordId;
		$rows = $conn->query($sql);
		foreach ($rows as $row) {
			$sql = "SELECT * FROM teachers WHERE id = " . $row['teacherId'];
			$teacherRows = $conn->query($sql)->fetchAll();
			$teacher = $teacherRows[0]['firstName'] . " " . $teacherRows[0]['lastName'];
			$count = $row['count'];
			print "<tr> <td> " . $teacher . "</td><td>" . $count . "</td></tr>"; 
		}
		print "</table>";
		
	} else {
		print "Teacher does not exist";
	}

} catch(PDOException $e) {
}

?>