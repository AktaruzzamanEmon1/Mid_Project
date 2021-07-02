<?php 
include "config.php";
	define("filepath", "user.json");
	$currentpassword = $newpassword = $confirmnewpassword = "";
	$isValid = true;
	$currentpasswordErr = $newpasswordErr = $confirmnewpasswordErr = "";
	$successfulMessage = $errorMessage = "";
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$currentpassword = $_POST['currentpassword'];
		$newpassword = $_POST['newpassword'];
		$confirmnewpassword = $_POST['confirmnewpassword'];
		if(empty($currentpassword)) {
			$currentpasswordErr = "Current Password can not be empty!";
			$isValid = false;
		}
		if(empty($newpassword)) {
			$newpasswordErr = "New Password can not be empty!";
			$isValid = false;
		}
		if(empty($confirmnewpassword)) {
			$confirmnewpasswordErr = " Confirm  New Password can not be empty!";
			$isValid = false;
		}
		if($isValid) {
			$currentpassword = test_input($currentpassword);
			$newpassword = test_input($newpassword);
			$confirmnewpassword = test_input($confirmnewpassword);

			$arr1 = array('currentpassword' => $currentpassword, "newpassword" => $newpassword, "confirmnewpassword" => $confirmnewpassword);
			$arr1_encode = json_encode($arr1);
			$response = write($arr1_encode);
			if($response) {
				$successfulMessage = "Password Changed Successfully";
			}
			else {
				$errorMessage = "Error while saving.";
			}
		}
	}
	function write($content) {
			$resource = fopen(filepath, "a");
			$fw = fwrite($resource, $content . "\n");
			fclose($resource);
			return $fw;
	}
	function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}
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

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<fieldset>
			<legend>Change Password:</legend>

			<label for="currentpassword">Current Password:</label>
			<input type="text" name="currentpassword" id="currentpassword">
			<span style="color:red"><?php echo $currentpasswordErr; ?></span>

			<br><br>

			<label for="newpassword">New Password:</label>
			<input type="password" name="newpassword" id="newpassword">
			<span style="color:red"><?php echo $newpasswordErr; ?></span>

			<br><br>

			<label for="confirmnewpassword">Confirm New Password:</label>
			<input type="password" name="confirmnewpassword" id="confirmnewpassword">
			<span style="color:red"><?php echo $confirmnewpasswordErr; ?></span>

			<br><br>

			<input type="submit" name="submit" value="Change Password">
		</fieldset>
	</form>

	<p style="color:green;"><?php echo $successfulMessage; ?></p>
	<p style="color:red;"><?php echo $errorMessage; ?></p>

	<br>

	
	<button style="background-color:  #ffb3ff"><a href="Manager.php">Back</a></button>

</body>
</html>