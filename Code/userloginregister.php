<?php
// define variables and set to empty values
$usernameErr = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  
  if (empty($_POST["username"])) {
    $usernameErr = "Please enter username/password";
  } else {
    $username = test_input($_POST["username"]);
  }
  
  if (empty($_POST["password"])) {
    $usernameErr = "Please enter username/password";
  } 
}

if (!empty($_POST["username"]) && !empty($_POST["password"]))
{
	$servername= "localhost";
    $usernamed = "root";
    $password = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    $uname=$_POST["username"];
    $pass=$_POST["password"];
    //echo $uname;
    //echo $pass;
    $sql = "SELECT password FROM user where username=('$uname')";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    if($row["password"]==$pass){
		$_SESSION['user_name']= $uname; 
        header("Location: userwelcome.php?q=$uname"); 
	}
    else {
		$usernameErr="Incorrect credentials!!! Please enter again.";
        //header("Location: userloginregister.php?q=1"); 
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
    <body>
    <div class="head" >
         <table >
            <tr>
                <td><img src="ll.jpeg" alt="logp" style="border-radius: 50%; width: 200px; height: 200px;"></td>
                <th >CYBER CRIME RECORDS MANAGEMENT SYSTEM</th>
            </tr>
        </table>
    </div>
		<div><h2><a href="mainpage.html">>>>Back</a></h2></div><br><br>

        <div class="table">
          <center>
            <h1>Enter Your login details Below </h1><br><br><br><br>
				    <form method="POST" action="#">
				      <table border="6.0"> 
                  <tr><td>&nbsp;&nbsp;Username:</td><td >&nbsp;&nbsp;&nbsp;<input type="text" name="username" placeholder="Enter Your User Name" value="<?php echo $username;?>"></td></tr>
                  <tr><td>&nbsp;&nbsp;Password:</td><td >&nbsp;&nbsp;&nbsp;<input type="password" name="password" placeholder="Enter Your Password"><br><span class="error"><?php echo $usernameErr;?></span></td></tr>
                  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" style="height:30px;  width: 90px;"></td><td>&nbsp;&nbsp;<a href="userreg.php">New User? Register here!!!</a></td></tr> 
              </table>   
					  </form>
          </center>
        </div><br><br><br><br><br><br><br><br>           
    <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;">
      <p>&copy;2022-2024&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presented By <strong>Sukesh P(4MH20IS093)</strong> & <strong>Shailesh S(4MH20IS082)</strong>.</p>
    </div>
    </body>
</html>
