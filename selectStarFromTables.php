
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
	
	$sql = "SELECT * FROM tables";
	
	print "<style> table, th, td {border: 1px solid black;} </style>";
	
	print "<table><tr><th>id</th><th>name</th><th>material</th></tr>";
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