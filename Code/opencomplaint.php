<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}

$opencomplaints = $errorMsg = "";

$servername= "localhost";
$usernamed = "root";
$passwords = "";
$dbname = "cybercrimedatabase";

$conn = new mysqli($servername, $usernamed, $passwords, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);

 }

$sql = "SELECT * FROM complaint WHERE status IN ('NEW','INPROGRESS','VERIFICATION')  ORDER BY datetime";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
	$opencomplaints = "<table border='2' style='column-width: 200px;color:#000080;border-color: aquamarine;border-collapse: collapse;border-style: groove;'>
	<tr><th>Complaint ID</th><th>Category</th><th>Subject</th><th>Details</th><th>Date</th><th>Crime Location</th><th>Social Media</th><th>Suspect Details</th><th>Status</th><th>Priority</th><th>Bureau Notes</th>
	</tr>";
	while($row = $result->fetch_assoc()) 
	{
	
		$opencomplaints = $opencomplaints . "<tr><td>" . $row['c_id'] . "</td><td>" . $row['category'] . "</td><td>" . $row['subject'] . "</td><td>" . $row['details'] . "</td><td>" . $row['datetime'] . "</td><td>". $row['area'] . "</td><td>" . $row['social_media'] . "</td><td>" . $row['suspect'] . "</td><td>" . $row["status"] . "</td><td>" . $row['priority'] . "</td><td>" . $row['bureau_notes'] . "</td></tr>";
	}
	$opencomplaints = $opencomplaints . "</table>";
} else {
	$errorMsg = "No Open Complaints in the system at this point!!!";
}
$conn->close();
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
		<div class="comp">
			<h2><a href="policewelcome.php?q=<?php echo $login_user;?>">>>>Back</a></h2>
            <h2 style="margin-left:460px;font:bold;font-size:45px;">All Open Complaints</h2>
		    <br><br>
		    <div><span class="error"><?php echo $errorMsg;?></span></div>
		    <div ><?php echo $opencomplaints;?></div>
		</div><br><br><br><br>
		<div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
            <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
        </div>
    </body>
</html>
