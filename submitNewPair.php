
<h1>This is cool</h1>


<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	print "Connected successfully"; 
	
	$first = $_GET['first'];
	$last = $_GET['last'];
	$word = $_GET['word'];

	$sql = "SELECT * FROM Teachers WHERE first-name = \"" . $first . "\" AND last-name = \"" . $last . "\";";
	$teacherRows = $conn->query($sql);

	$teacherId;
	if (teacherRow.length > 0) {
		$teacherId = teacherRow[0]['id'];
	} else {
		$sql = "INSERT INTO Teachers (first-name, last-name) VALUES (\"" . $first . "\", \"" . $last . "\")";
		$conn->query($sql);
		$teacherId = $conn->lastInsertId();
	}
	foreach ($conn->query($sql) as $row) {
		print "<tr>";
        print "<td>" . $row['id'] . "</td>";
        print "<td>" . $row['name'] . "</td>";
        print "<td>" . $row['material'] . "</td>";
		print "</tr>";
    }
	print "</table>";
	
	
    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>