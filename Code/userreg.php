<?php
// define variables and set to empty values
$nameErr = $usernameErr = $passwordErr = $addressErr = $pincodeErr = $emailErr = $genderErr = "";
$name = $username = $password = $address = $pincode = $email = $gender = $phone = "";
$successMsg = $errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
    // check if username only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
      $usernameErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check if password only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$password)) {
      $passwordErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
  }
  
  if (empty($_POST["pincode"])) {
    $pincodeErr = "Pincode is required";
  } else {
    $pincode = test_input($_POST["pincode"]);
    // check if pincode only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$pincode)) {
      $pincodeErr = "Only numbers allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
  
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if (empty($_POST["phone"])) {
    $phone = "";
  } else {
    $phone = test_input($_POST["phone"]);
  }

}

if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["pincode"]) && !empty($_POST["email"]) && !empty($_POST["gender"]) && $nameErr == "" && $usernameErr == "" && $passwordErr == "" && $pincodeErr == "" && $emailErr == "")
{
	$servername= "localhost";
    $usernamed = "root";
    $passwords = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    
    $sql = "INSERT INTO user (username, password, name, address, pincode, email, phone, gender) VALUES ('$username','$password','$name','$address','$pincode','$email','$phone','$gender')";
    if ($conn->query($sql) === TRUE) {
    $successMsg = "Registration Successful. Click on BACK button at the top to LOGIN.";
    } 
	else {
    $errorMsg = "Username $username already exists. Please enter another username.";
    }
	$conn->close();
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
        <title>Cyber Crime Records Management System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="Stylesheet">
		    <link href="icon.jpeg" rel="icon" style="border-radius: 50%;">
    </head>
    <body>
      <div class="head" >
        <table >
          <tr>
            <td><img src="ll.jpeg" alt="logp" style="border-radius: 50%; width: 200px; height: 200px;"></td>
            <th >CYBER CRIME RECORDS MANAGEMENT SYSTEM</th>
          </tr>
        </table>
      </div><br>
		<div><h2><a href="userloginregister.php">>>>Back</a></h2></div>
      <h1 style="margin-left:510px;font:bold;font-size:45px;margin-top:50px;"> USER REGISTRATION </h1><br>
        <div class='table'> 
          <center>
			      <form method="post" action="#">
			        <table border="6.0" > 
					      <tr><td >&nbsp;&nbsp;Name:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="name" value="<?php echo $name;?>"><span class="error">* <?php echo $nameErr;?></span></td></tr>
					      <tr><td >&nbsp;&nbsp;Username:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="username" placeholder="Remember your username" value="<?php echo $username;?>"><span class="error">* <?php echo $usernameErr;?></span></td></tr>
					      <tr><td >&nbsp;&nbsp;Password:</td><td >&nbsp;&nbsp;&nbsp;<input type="password" name="password" placeholder="Remember your password" ><span class="error">* <?php echo $passwordErr;?></span></td></tr>
					      <tr><td >&nbsp;&nbsp;Address:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="address" value="<?php echo $address;?>"><span class="error">* <?php echo $addressErr;?></span></td></tr>
				        <tr><td >&nbsp;&nbsp;Pincode:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="pincode" value="<?php echo $pincode;?>"><span class="error">* <?php echo $pincodeErr;?></span></td></tr>
					      <tr><td>&nbsp;&nbsp;Email ID:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="email" value="<?php echo $email;?>"><span class="error">* <?php echo $emailErr;?></span></td></tr>
				        <tr><td >&nbsp;&nbsp;Phone No:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="phone" value="<?php echo $phone;?>"></td></tr>
				        <tr><td >&nbsp;&nbsp;Gender:</td><td >&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
					      <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male<span class="error">* <?php echo $genderErr;?></span></td></tr>
				        <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit" value="Submit"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="success"><?php echo $successMsg;?></span><span class="error"><?php echo $errorMsg;?></span></td></tr>
			        </table>
			      </form>
          </center>
	      </div><br><br><br><br>
      <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
        <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
      </div>
    </body>
</html>
