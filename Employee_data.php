<?php
include "config.php"; 
	session_start();
	$userId = isset($_SESSION['uid']) ? $_SESSION['uid'] : ""; 
?>
<!DOCTYPE html>
<html>
<head>
	<body style="background-color:#CCCCFF;">
	<meta charset="utf-8">
	<?php include 'Title.php'; ?>
</head>
<body>
	<h1><?php include 'Top_Heading.php'; ?> </h1>

	<h2>Employee List</h2>
	<fieldset>
		<button style="background-color:  #ffb3ff"><a href="Manager.php">Back</a></button>
		<button style="background-color:  #ffb3ff"><a href="Home_page.php">Home</a></button>
	<button style="background-color:  #ffb3ff"><a href="">Update Profile</a></button>
	
	<button style="background-color:  #ffb3ff"><a href="Login.php">Logout</a></button>
</fieldset>

	<?php 
		define("filepath", "Employee_data.json");
		if($userId === "Emon602") {
			function read() {
				$resource = fopen(filepath, "r");
				$fz = filesize(filepath);
				$fr = "";
				if($fz > 0) {
					$fr = fread($resource, $fz);
				}
				fclose($resource);
				return $fr;
			}

			$users_list = read();
			$users_list_array = explode("\n", $users_list);
			
			echo "<table border=>";


			echo "<tr><th>Full Name</th>";
			echo "<th>Address</th>";
			echo "<th>Phone Number</th>";
			echo "<th>User Name</th>";
			echo "<th>Password</th></tr>";
			for($i = 0; $i < count($users_list_array) - 1; $i++) {
				$users_list_array_decode = json_decode($users_list_array[$i]);
				echo "<tr>";
				echo "<td>" . $users_list_array_decode->fullname . "</td>";
				echo "<td>" . $users_list_array_decode->address . "</td>";
				echo "<td>" . $users_list_array_decode->phone . "</td>";
				echo "<td>" . $users_list_array_decode->username . "</td>";
				echo "<td>" . $users_list_array_decode->password . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else {
			echo "<h3 style='color:red;'>Access Denied</h3>";
		}

	?>
	
</body>
</html>