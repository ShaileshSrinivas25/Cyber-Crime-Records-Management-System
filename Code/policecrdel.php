<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}

// define variables and set to empty values
$successMsg = $errorMsg = $status = $statusErr = "";
$statusresult = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["status"])) {
    $statusErr = "Criminal ID is required";
  } else {
    $status = test_input($_POST["status"]);
    // check if subject only contains letters and whitespace
    if (!preg_match("/^CR[0-9]{3}$/",$status)) {
      $statusErr = "Criminal ID format is Invalid."; 
    }
  }
}

if (!empty($_POST["status"]) && $statusErr == "")
{
	$servername= "localhost";
    $usernamed = "root";
    $passwords = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    
    $sql = "SELECT * from criminal WHERE cr_id = '$status'";
	$result=$conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['cr_name'] != NULL) {
        $successMsg = "The criminal id $status is removed from Records";
		$sql2 = "DELETE  from criminal where cr_id='$status'";
        $result = $conn->query($sql2);
    } else {
        $errorMsg = "No record for the given Criminal ID found. <br>Please try again with a valid Criminal ID!!!";
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
       <a href="policerecords.php?q=<?php echo $login_user;?>"><h1><<< Back</h1></a><br>
		  <div class="stable">
        <center>
        <h3  style="font:bold;font-size:45px;">CRIMINAL ID</h3><br>
				  <form method="post" action="#">
			    	<table border="6.0" style="color:#000080;border-color: aquamarine;height: 200px;width: 550px;border-collapse: collapse;">
					    <tr><td>&nbsp;&nbsp;Enter Criminal Id:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="status" placeholder="Format of ID: CRXXX"><span class="error">* <?php echo $statusErr;?></span></td></tr>
				    	<tr style="text-align: center;"><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit" value="Submit"><br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="success"><?php echo $successMsg;?></span><span class="error"><?php echo $errorMsg;?></span></td></tr>
				    </table>
				  </form>
			  </center>
      </div>
      <br><br><br><br><br><br>
    <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray;color: white; text-align: center;" >
      <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
    </div>
  </body>
</html>
