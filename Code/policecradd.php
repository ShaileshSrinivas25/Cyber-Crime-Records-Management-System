<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
// define variables and set to empty values
$specErr = $crnameErr = $ageErr = $genderErr = $dateErr = $nationErr = "";
$spec = $crname = $age = $gender = $dates = $nation = $sen= $info="";
$successMsg = $errorMsg = $p= "";

$servername= "localhost";
$usernamed = "root";
$passwords = "";
$dbname = "cybercrimedatabase";

$conn = new mysqli($servername, $usernamed, $passwords, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$p= $_GET['q'];
$sql2= "SELECT * FROM police WHERE police_id='$p'";
$result = $conn->query($sql2);
$row = $result ->fetch_assoc();
$spec = $row['specialization'];    
$conn->close();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $crnameErr = "name is required";
  } else {
    $crname = test_input($_POST["name"]);
    //  subject only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$crname)) {
      $crnameErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["age"])) {
    $ageErr = "age is required";
  } else {
    $age = test_input($_POST["age"]);
  }
  
  if (empty($_POST["dates"])) {
    $dateErr = "Date is required";
  } else {
    $dates = test_input($_POST["dates"]);
  }
  
  if (empty($_POST["gender"])) {
    $genderErr = "gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
    // check if area only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$gender)) {
      $genderErr = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["nation"])) {
    $nationErr = "Nationality is required";
  } else {
    $nation = test_input($_POST["gender"]);
    // check if area only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$gender)) {
      $nationErr = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["info"])) {
    $info = "";
  } else {
    $info = $_POST["info"];
  }
  if (empty($_POST["sen"])) {
    $sen = "";
  } else {
    $sen = $_POST["sen"];
  }

}

if ( !empty($_POST["name"])  && !empty($_POST["dates"]) && !empty($_POST["sen"]) && !empty($_POST["sen"]) )
{
	$servername= "localhost";
    $usernamed = "root";
    $passwords = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    $p= $_GET['q'];
    $sql2= "SELECT * FROM police WHERE police_id='$p'";
    $result = $conn->query($sql2);
    $row = $result ->fetch_assoc();
    $spec = $row['specialization'];
    $sql = "INSERT INTO criminal (cr_id, cr_name, age, dob, gender, nation, spec, info, sen_info,police_id) VALUES ('$cr_id','$crname','$age','$dates','$gender','$nation','$spec','$info','$sen','$p')";
	 
    if ($conn->query($sql) === TRUE) {
    $successMsg = "Criminal Recorded added successfully. Criminal ID is $cr_id ";
    } 
	else{
    $errorMsg = "Some Internal Error Occurred. Please Try Again!!!";
    }
	$conn->close();
}

function generateRandomString($length=3) {
    $characters = "1234567890";
    $len = strlen($characters);
    $randomString = 'CR';
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
        <a href="policerecords.php?q=<?php echo $login_user;?>"><h1><<< Back</h1></a><br>
        <?php $login_user; ?>
        <div class="table">
            <center>
                <h1 style="font:bold;font-size:45px;">New Criminal Form</h1><br>
			        <form method="post" action="#">
                <table border="6.0" > 
                  <tr>
                    <td>&nbsp;&nbsp;Specialization: </td>
                    <td>&nbsp;&nbsp; <?php echo $spec; ?></td>
                  </tr>
                  <tr><td >&nbsp;&nbsp;Criminal Name:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Name of Criminal" name=" name" value="<?php echo $crname;?>"><span class="error">* <?php echo $crnameErr;?></span></td></tr>
                  <tr><td >&nbsp;&nbsp;Age:</td><td >&nbsp;&nbsp;&nbsp; <input type="text" name="age" value="<?php echo $age;?>"><span class="error">* <?php echo $ageErr;?></span></td></tr>
					        <tr><td >&nbsp;&nbsp;Date of Birth:</td><td >&nbsp;&nbsp;&nbsp;<input type="date" name="dates" value="<?php echo $dates;?>"><span class="error"><?php echo $dateErr;?></span></td></tr>
					        <tr><td >&nbsp;&nbsp;Gender:</td><td >&nbsp;&nbsp;&nbsp; <input type="text" name="gender" value="<?php echo $gender;?> " required><span class="error"><?php echo $genderErr;?></span> </td></tr>
                  <tr><td >&nbsp;&nbsp;Nationality:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="nation" value="<?php echo $nation;?>"><span class="error">* <?php echo $nationErr;?></span></td></tr>
                  <tr><td >&nbsp;&nbsp;Criminal Info:</td><td>&nbsp;&nbsp;&nbsp;<textarea name="info" maxlength="50"><?php $info; ?></textarea></td>
                  <tr><td >&nbsp;&nbsp;Prizon Sentence:</td><td>&nbsp;&nbsp;&nbsp;<textarea name="sen" maxlength="50"><?php $sen; ?></textarea></td>
					        <tr style="text-align: center;"><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit" value="Submit">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="error"><?php echo $errorMsg;?></span><span class="success"><?php echo $successMsg;?></span></td></tr>
                </table>      
				     </form>
			      </center>
        </div><br><br><br> 
        <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
          <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
        </div>
    </body>
</html>