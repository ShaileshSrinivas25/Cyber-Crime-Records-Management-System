<?php 
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
$searchERR = $search = "";
$servername= "localhost";
$usernamed = "root";
$passwords = "";
$dbname = "cybercrimedatabase";

$conn = new mysqli($servername, $usernamed, $passwords, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
 }

$sql = "SELECT * FROM criminal order by cr_id";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
	$openrecords = "<table border='2' style='width:100%;color:#000080;border-color: aquamarine;border-collapse: collapse;border-style: groove;'>
	<tr><th>Criminal ID</th><th>Criminal Name</th><th>Age</th><th>Date of Birth</th><th>Gender</th><th>Nationality</th><th>Specialzation</th><th>Crime Info</th><th>Prizon statement</th></tr>";
    while($row = $result->fetch_assoc()) 
	{
		$openrecords = $openrecords . "<tr><td>" . $row['cr_id'] . "</td><td>" . $row['cr_name'] . "</td><td>" . $row["age"]."</td><td>" . $row["dob"] . "</td><td>" . $row['gender'] . "</td><td>" . $row['nation'] . "</td><td>" . $row['spec'] . "</td><td>". $row['info'] . "</td><td>" . $row['sen_info'] ."</td></tr>";
	}
	$openrecords = $openrecords . "</table>";

}
if (empty($_POST["search"])) {
    $searchERR= " The search box cannot be empty.Please  entry Criminal Id,name or specialzation";
  } else {
    $search = $_POST["search"];
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
        </div><br><br>
        <div class="in">
            <a href="policewelcome.php?q=<?php echo $login_user;?>"><h2>>>>Back</h2></a><br><br>
            <center>
                <a href="policecradd.php?q=<?php echo $login_user; ?>"><button class="add">Add a Criminal record</button></a>
                <a href="policecrdel.php?q=<?php echo $login_user; ?>"><button class="del">Delete a Criminal record</button></a><br><br>
                <h1 style="font-size:100px; color:crimson;">All Criminal Records List</h1>
		    <div ><?php echo $openrecords;?></div>
         </div><br><br><br>
        <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
            <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
        </div>
    </body>
</html>