<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}

$mycomplaints = $errorMsg = $spec = "";

$servername= "localhost";
$usernamed = "root";
$passwords = "";
$dbname = "cybercrimedatabase";

$conn = new mysqli($servername, $usernamed, $passwords, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
 }

$sql2 = "SELECT * FROM police WHERE police_id = '$login_user'";
$result2=$conn->query($sql2);
$row2=$result2->fetch_assoc();
$spec=$row2["specialization"];
$spec=test_input($spec);

$sql = "SELECT * FROM complaint WHERE category = '$spec'";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
	$mycomplaints = "<table border='2' style='width:100%; height:100%; color:#000080;border-color: aquamarine;border-collapse: collapse;border-style: groove;'>
	<tr><th>Complaint ID</th><th>Category</th><th>Subject</th><th>Details</th><th>Date</th><th>Crime Location</th><th>Social Media</th><th>Suspect Details</th><th>Status</th><th>Priority</th><th>Bureau Notes</th><th>Action</th>
	</tr>";
	while($row = $result->fetch_assoc()) 
	{
		$compid=$row['c_id'];
		$linkc = "<a  href='viewandupdatecomplaint.php?q=$login_user&c=$compid'>View and Update</a>";
		$mycomplaints = $mycomplaints . "<tr><td>" . $row['c_id'] . "</td><td>" . $row['category'] . "</td><td>" . $row['subject'] . "</td><td>" . $row['details'] . "</td><td>" . $row['datetime'] . "</td><td>". $row['area'] . "</td><td>" . $row['social_media'] . "</td><td>" . $row['suspect'] . "</td><td>" . $row["status"] . "</td><td>" . $row['priority'] . "</td><td>" . $row['bureau_notes'] . "</td><td>" . $linkc ."</td></tr>";
	}
	$mycomplaints = $mycomplaints . "</table>";
} else {
	$errorMsg = "No $spec category complaints in the system at this point!!!";
}
$conn->close();

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
    <body>
	    <div class="head" >
            <table >
                <tr>
                    <td><img src="ll.jpeg" alt="logp" style="border-radius: 50%; width: 200px; height: 200px;"></td>
                    <th >CYBER CRIME RECORDS MANAGEMENT SYSTEM</th>
                </tr>
            </table>
        </div><br><br>
		<div><h2><a href="policewelcome.php?q=<?php echo $login_user;?>">>>Back</a></h2></div>
		<center>
        <h2 style="font:bold;font-size:45px;"><i><?php echo $spec; ?></i>&nbsp;&nbsp;Complaints</h2>
		<br><br>
		<div><span class="error"><?php echo $errorMsg;?></span></div>
		<div id="mycomplaints"><?php echo $mycomplaints;?></div>
		</center>
        <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
            <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
        </div>
    </body>
</html>
