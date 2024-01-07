<?php
// define variables and set to empty values
$nameErr = $usernameErr = $passwordErr = $addressErr = $phoneErr = $genderErr = $specErr = "";
$name = $username = $password = $address = $phone = $gender = $spec = "";
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
  
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["phone"]);
	if (!preg_match("/^[0-9]*$/",$phone)) {
      $phoneErr = "Only numbers allowed"; 
    }
  }
  
  if(isset($_POST['specialization']) && $_POST['specialization'] == '0') { 
    $specErr = "Specialization is required";
  } else {
	  $spec = test_input($_POST["specialization"]);
  }

}

if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["phone"]) && !empty($_POST["gender"]) && isset($_POST['specialization']) && $_POST['specialization'] != '0' && $phoneErr == "" && $passwordErr == "" && $usernameErr == "" && $nameErr == "")
{
	$servername= "localhost";
    $usernamed = "root";
    $passwords = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    
    $sql = "INSERT INTO police (police_id, name, password, phone, gender, address, specialization) VALUES ('$username','$name','$password','$phone','$gender','$address','$spec')";
    if ($conn->query($sql) === TRUE) {
    $successMsg = "Registration Successful. Click on BACK button at the top to LOGIN.";
    } 
	else {
    $errorMsg = "Username/Police ID $username already exists. Please enter another username/Police ID.";
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
		    <link href="ll.jpeg" rel="icon" style="border-radius: 50%;">
    </head>
    <body ">
     <div class="head" >
         <table >
            <tr>
                <td><img src="ll.jpeg" alt="logp" style="border-radius: 50%; width: 200px; height: 200px;"></td>
                <th >CYBER CRIME RECORDS MANAGEMENT SYSTEM</th>
            </tr>
        </table>
      </div>
		<div><h2><a href="policeloginregister.php">>>>Back</a></h2></div><br><br>
        <div class="table"> 
          <center>
            <h1 style="font:bold;font-size:45px;"> POLICE REGISTERATION </h1><br><br>
			      <form method="post" action="#">
			        <table border="6.0"> 
                    <tr><td >&nbsp;&nbsp;Name:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="name" value="<?php echo $name;?>"><span class="error">* <?php echo $nameErr;?></span></td></tr>
                    <tr><td >&nbsp;&nbsp;Username/Police ID:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="username" value="<?php echo $username;?>"><span class="error">* <?php echo $usernameErr;?></span></td></tr>
                    <tr><td >&nbsp;&nbsp;Password:</td><td >&nbsp;&nbsp;&nbsp;<input type="password" name="password" ><span class="error">* <?php echo $passwordErr;?></span></td></tr>
                    <tr><td >&nbsp;&nbsp;Address:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="address" value="<?php echo $address;?>"><span class="error">* <?php echo $addressErr;?></span></td></tr>
                    <tr><td >&nbsp;&nbsp;Phone No:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="phone" value="<?php echo $phone;?>"><span class="error">* <?php echo $phoneErr;?></span></td></tr>
                    <tr><td >&nbsp;&nbsp;Gender:</td><td >&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
					<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male<span class="error">* <?php echo $genderErr;?></span></td></tr>
                    <tr><td>&nbsp;&nbsp;Specialization: </td><td>
					<select name="specialization">
					    <option value="0">Please Select</option>
                        <option>Bank Account Fraud</option>
                        <option>Cyberbullying</option>
						<option>Child Pornography</option>
						<option>Identity Theft</option>
						<option>Social Media Crime</option>
						<option>Hacking and Viruses</option>
						<option>E-Commerce Scam</option>
						<option>Email or Phone Call Scam</option>
                        </select><span class="error">* <?php echo $specErr;?></span></td></tr>
                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit" value="Submit"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Exit" onclick="location.href='mainpage.html';" style="width:65px;"><br><span class="success"><?php echo $successMsg;?></span><span class="error"><?php echo $errorMsg;?></span></td></tr>
				</table>
				</form>
            </center>
	    </div><br><br><br>
      <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
         <p>&copy;2022-2024&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
      </div>
    </body>
</html>
