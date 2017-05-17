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

	$sql = "SELECT * FROM teachers WHERE firstName = \"" . $first . "\" AND lastName = \"" . $last . "\";";
	$teacherRows = $conn->query($sql)->fetchAll();

	$teacherId;
	if (count($teacherRows) > 0) {
		$teacherId = $teacherRows[0]['id'];
		print $first . " " . $last . " is associated with: <br>";
		print "<table>";
		$sql = "SELECT * FROM teacherToWord WHERE teacherId = " . $teacherId;
		$rows = $conn->query($sql);
		foreach ($rows as $row) {
			$sql = "SELECT * FROM words WHERE id = " . $row['wordId'];
			$wordRows = $conn->query($sql)->fetchAll();
			$word = $wordRows[0]['word'];
			$count = $row['count'];
			print "<tr> <td> " . $word . "</td><td>" . $count . "</td></tr>"; 
		}
		print "</table>";
		
	} else {
		print "Teacher does not exist";
	}

} catch(PDOException $e) {
}

?>