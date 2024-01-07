<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
$servername= "localhost";
    $usernamed = "root";
    $password = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
     $sql2="SELECT name from user where username=('$login_user')";
     $result2=$conn->query($sql2);
     $row2=$result2->fetch_assoc();
     $name= $row2["name"];
$sql="SELECT gender from user where username=('$login_user')";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if($row["gender"]=="male"){
    $g="Mr.";
}
else {
    $g = "Miss.";
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
        </div><br><br><br>
        <center > 
            <h2 style="font-size:40px;">WELCOME&nbsp;<b><?php echo $g ?><?php echo $name; ?></b></h2><br><br><br><br><br><br>
            <button><a href="userviewupdate.php?q=<?php echo $login_user; ?>">VIEW AND UPDATE MY DETAILS</a></button><br><br><br>
            <button><a href="newcomplaint.php?q=<?php echo $login_user; ?>">NEW COMPLAINT</a></button><br><br><br>
            <button><a href="checkstatus.php?q=<?php echo $login_user; ?>">COMPLAINT STATUS</a></button><br><br><br>
            <button><a href="mainpage.html">LOGOUT</a></button><br><br><br>
        </center>
        <br><br><br><br><br>
        <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray;color: white; text-align: center;" >
            <p>&copy;2022-2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
        </div>
    </body>
</html>
