<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
// define variables and set to empty values
$specErr = $subjectErr = $detailsErr = $socialErr = $dateErr = $areaErr = "";
$spec = $subject = $details = $social = $dates = $area = $suspect = $user_id= "";
$successMsg = $errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if(isset($_POST['specialization']) && $_POST['specialization'] == '0') { 
    $specErr = "Category is required";
  } else {
	 $spec = test_input($_POST["specialization"]);
  }
  
  if (empty($_POST["subject"])) {
    $subjectErr = "Subject is required";
  } else {
    $subject = test_input($_POST["subject"]);
    //  subject only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$subject)) {
      $subjectErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["details"])) {
    $detailsErr = "Details is required";
  } else {
    $details = test_input($_POST["details"]);
  }
  
  if (empty($_POST["social"])) {
    $social = "";
  } else {
    $social = test_input($_POST["social"]);
    // check if social only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$social)) {
      $socialErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["area"])) {
    $areaErr = "Area/Place is required";
  } else {
    $area = test_input($_POST["area"]);
    // check if area only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$area)) {
      $areaErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["dates"])) {
    $dateErr = "Date is required";
  } else {
    $dates = test_input($_POST["dates"]);
  }
  
  if (empty($_POST["suspect"])) {
    $suspect = "";
  } else {
    $suspect = test_input($_POST["suspect"]);
  }

}

if (!empty($_POST["subject"]) && !empty($_POST["details"])  && !empty($_POST["dates"]) && !empty($_POST["area"]) && isset($_POST['specialization']) && $_POST['specialization'] != '0' && $areaErr == "" && $socialErr == "" && $subjectErr == "")
{
	$servername= "localhost";
    $usernamed = "root";
    $passwords = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
     $user= $_GET["q"];
     $c_id= generateRandomString();
    $sql = "INSERT INTO complaint (c_id, category, subject, details, social_media, datetime, suspect, area, status, priority,username) VALUES ('$c_id','$spec','$subject','$details','$social','$dates','$suspect','$area','NEW','','$user')";
	 
    if ($conn->query($sql) === TRUE) {
    $successMsg = "Complaint submitted successfully. Complaint ID is $c_id (Please take a note of it) <br> Click on BACK button to Check Status.";
    } 
	else {
    $errorMsg = "Some Internal Error Occurred. Please Try Again!!!";
    }
	$conn->close();
}

function generateRandomString($length=3) {
  $characters = "1234567890";
  $len = strlen($characters);
  $randomString = 'C';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $len - 1)];
}
  return $randomString;
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
        <a href="userwelcome.php?q=<?php echo $login_user;?>"><h1><<< Back</h1></a><br>
      <div class="table">
        <center>
          <h1 style="font:bold;font-size:45px;">New Complaint Form</h1><br>
			      <form method="post" action="#">
                <table border="6.0" > 
                    <tr>
                        <td>&nbsp;&nbsp;Category: </td><td>&nbsp;&nbsp;
					                <select name="specialization">
					                  <option value="0">Please Select</option>
                            <option>Bank Account Fraud </option>
                            <option>Cyberbullying</option>
						                <option>Child Pornography</option>
					                	<option>Identity Theft</option>
						                <option>Social Media Crime</option>
						                <option>Hacking and Viruses</option>
						                <option>E-Commerce Scam</option>
						                <option>Email or Phone Call Scam</option>
                          </select><span class="error">* <?php echo $specErr;?></span>
                        </td>
                    </tr>
                    <tr><td >&nbsp;&nbsp;Subject:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="subject" value="<?php echo $subject;?>"><span class="error">* <?php echo $subjectErr;?></span></td></tr>
				          	<tr><td >&nbsp;&nbsp;Details:</td><td >&nbsp;&nbsp;&nbsp; <textarea name="details"><?php echo $details;?></textarea><span class="error">* <?php echo $detailsErr;?></span></td></tr>
					          <tr><td >&nbsp;&nbsp;Social Media:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="social" value="<?php echo $social;?>"><span class="error"><?php echo $socialErr;?></span></td></tr>
					          <tr><td >&nbsp;&nbsp;Suspect Details:</td><td >&nbsp;&nbsp;&nbsp; <textarea name="suspect"><?php echo $suspect;?></textarea></td></tr>
					          <tr><td >&nbsp;&nbsp;Date:</td><td >&nbsp;&nbsp;&nbsp;<input type="date" name="dates" value="<?php echo $dates;?>"><span class="error">* <?php echo $dateErr;?></span></td></tr>
					          <tr><td >&nbsp;&nbsp;Area:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="area" value="<?php echo $area;?>"><span class="error">* <?php echo $areaErr;?></span></td></tr>
					          <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit" value="Submit"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="error"><?php echo $errorMsg;?></span><span class="success"><?php echo $successMsg;?></span></td></tr>
                </table>      
				   </form>
			  </center>
      </div><br><br><br> 
      <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
        <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
      </div>
    </body>
</html>