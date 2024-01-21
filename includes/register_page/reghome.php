

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Register</title>
    <link rel="icon" type="image/png" href = "../../images/favcon.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='register.css'>

</head>
<body>
    
    <div class = "mcontainer">
    <form action = "signup.inc.php" method='POST' novalidate>
        <!--Title-->
        <h1 class = "Title">Register</h1>
        <div class = "inputs">
        <!--Email-->
        <label for="Email"><b>Email</b></label>
        <input type ="text" placeholder="Enter Email" name = "email" id  = "Email"required>
        <!--Passwoord-->
        <label for="psw" class = "psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <!--Repeat password-->
        <label for="Rpsw" class = "psw"><b>Repeat Password</b></label>
        <input type="password" placeholder="Enter Password"  name="Rpsw" required>
        </div>
        <!--Submit button-->
        <button type="submit" class = "reg">Register</button>
    </div>
    </form>
</body>
</html>