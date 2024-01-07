<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
$addressErr = $phoneErr = $specErr = "";
$name = $username = $address = $spec = $gender = $phone = "";
$successMsg = $errorMsg = "";

//DB Connection
$servername= "localhost";
$usernamed = "root";
$passwords = "";
$dbname = "cybercrimedatabase";

$conn = new mysqli($servername, $usernamed, $passwords, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$login_user = test_input($login_user);
$sql = "SELECT * from police where police_id='$login_user'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$name=$row["name"];
$username=$row["police_id"];
$address=$row["address"];
$spec=$row["specialization"];
$phone=$row["phone"];
$gender=$row["gender"];

$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
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

if (!empty($_POST["address"]) && !empty($_POST["phone"]) && isset($_POST['specialization']) && $_POST['specialization'] != '0' && $phoneErr == "")
{	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    
    $sql = "UPDATE police SET address = '$address', phone = '$phone', specialization = '$spec' WHERE police_id = '$login_user'";
    if ($conn->query($sql) === TRUE) {
    $successMsg = "Update Successful. Click on BACK button.";
    } 
	else {
    $errorMsg = "Update Failed due to some Internal Error!!! Please try again.";
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
    <body >
      <div class="head" >
        <table >
          <tr>
            <td><img src="ll.jpeg" alt="logp" style="border-radius: 50%; width: 200px; height: 200px;"></td>
            <th >CYBER CRIME RECORDS MANAGEMENT SYSTEM</th>
          </tr>
        </table>
      </div> 
        <a href="policewelcome.php?q=<?php echo $login_user;?>"><h2>>>>Back</h2></a><br>  
        <div class="table">
        <center>
        <h2 style="font:bold;font-size:45px;"> View and Update My Details</h2><br><br>
		    <form method="post" action="#">
		      <table border="6.0"> 
				    <tr><td >&nbsp;&nbsp;Username/Police ID:</td><td>&nbsp;&nbsp;&nbsp; <?php echo $username; ?></td></tr>
				    <tr><td >&nbsp;&nbsp;Name:</td><td>&nbsp;&nbsp;&nbsp; <?php echo $name; ?></td></tr>
				    <tr><td >&nbsp;&nbsp;Gender:</td><td>&nbsp;&nbsp;&nbsp; <?php echo $gender; ?></td></tr>
				    <tr><td >&nbsp;&nbsp;Address:</td><td >&nbsp;&nbsp;&nbsp; <input type="text" name="address" value="<?php echo $address; ?>"><span class="error">* <?php echo $addressErr;?></span></td></tr>
				    <tr><td >&nbsp;&nbsp;Phone No:</td><td >&nbsp;&nbsp;&nbsp; <input type="text" name="phone" value="<?php echo $phone; ?>"><span class="error">* <?php echo $phoneErr;?></span></td></tr>
				    <tr><td>&nbsp;&nbsp;Specialization: </td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $spec; ?> <br> &nbsp;&nbsp;&nbsp;
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
				     <tr style="text-align: center;"><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit" value="Update">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <br><span class="success"><?php echo $successMsg;?></span><span class="error"><?php echo $errorMsg;?></span></td></tr>
            </table>
			</form>
        </center>
        </div> <br><br><br>
      <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
        <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
      </div>
    </body>
</html>
