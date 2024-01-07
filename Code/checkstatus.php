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
    $statusErr = "Complaint ID is required";
  } else {
    $status = test_input($_POST["status"]);
    // check if subject only contains letters and whitespace
    if (!preg_match("/^C[0-9]{3}$/",$status)) {
      $statusErr = "Complaint ID format is Invalid."; 
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
    
    $sql = "SELECT * from complaint WHERE c_id = '$status'";
	$result=$conn->query($sql);
    if ($result->num_rows > 0) {
        $successMsg = "Please find the status of the given Complaint ID below";
		$statusresult = "<table border='2' style='column-width: 400px; height:200px; color:#000080; border-color: aquamarine;'>
		<tr><th>Complaint ID</th><th>Category</th><th>Subject</th><th>Details</th><th>Date</th><th>Crime Location</th><th>Status</th><th>Priority</th><th>Bureau Notes</th>
		</tr>";
        while($row = $result->fetch_assoc()) 
		{
            $statusresult = $statusresult . "<tr><td>" . $row['c_id'] . "</td><td>" . $row['category'] . "</td><td>" . $row['subject'] . "</td><td>" . $row['details'] . "</td><td>" . $row['datetime'] . "</td><td>". $row['area'] . "</td><td>" . $row['status'] . "</td><td>" . $row['priority'] . "</td><td>" . $row['bureau_notes'] . "</td></tr>";
        }
		$statusresult = $statusresult . "</table>";
    } else {
        $errorMsg = "No record for the given complaint ID found. <br>Please try again with a valid complaint ID!!!";
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
       <a href="userwelcome.php?q=<?php echo $login_user;?>"><h1><<< Back</h1></a><br>
		  <div class="stable">
        <center>
        <h3  style="font:bold;font-size:45px;">Complaint Status</h3><br>
				  <form method="post" action="#">
			    	<table border="6.0" style="color:#000080;border-color: aquamarine;height: 200px;width: 550px;border-collapse: collapse;">
					    <tr><td >&nbsp;&nbsp;Enter Complaint Id:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="status" placeholder="Format of ID: CXXX"><span class="error">* <?php echo $statusErr;?></span></td></tr>
				    	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit" value="Submit"></td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="success"><?php echo $successMsg;?></span><span class="error"><?php echo $errorMsg;?></span></td></tr>
				    </table>
				  </form>
			  </center>
      </div>
      <br><br>
		  <div id="statusresult"> <?php echo $statusresult;?></div><br><br><br><br><br>
    <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray;color: white; text-align: center;" >
      <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
    </div>
  </body>
</html>
