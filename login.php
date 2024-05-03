<?php
    include 'connection.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
    <form method="post">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="email" id="email" name="email" placeholder="Please enter mail id with .gecg28" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
        <input type="submit" name="login" value="Login">
    </form>
</div>
<?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM login WHERE email='".$email."' AND password='".$password."'";
        $run = mysqli_query($con,$query);
        if(mysqli_num_rows($run) == 1){
            session_start();
            $_SESSION['sess_user'] = $email;
            header("Location:index.php");
            exit(); 
        }
        else{
            echo "<script>alert('Enter correct email id and password');</script>";
        }
    }
?>
</body>
</html>

