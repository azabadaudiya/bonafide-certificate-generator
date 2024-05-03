<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['sess_user'])) {
    header("Location:login.php");
} else {
    $email = $_SESSION['sess_user'];

    // Fetch user data
    $query = "SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);

    // Check if form is submitted for profile update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $password = $_POST['password'];

        // Update user data in the database
        $update_query = "UPDATE login SET name='$name',  password='$password' WHERE email='$email'";
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            header("Location:user_faculty_profile_update.php ");
            
             
            exit;
        } else {
            echo "<script>alert('profile not Updated')</script>";
            header("Location:user_faculty_profile_update.php ");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEC Gandhinagar</title>
    <link rel="stylesheet" href="css/user_faculty_profile_update.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .user-container {
            max-width: 800px;
            margin: 70px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-details {
            flex: 1;
            padding: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-top: 5px;
        }

        #editBtn {
    padding: 10px 20px;
    background-color: #060E40;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 50%;
    display: block;
    margin: auto; /* Center the button horizontally */
}

        #editBtn:hover {
            background-color: #0056b3;
        }

        .profile-image img {
            max-width: 200px;
            height: 200px;
            border-radius: 50%;
        }
        h2{
            color: #060E40;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <?php include 'menu.php'; ?>
    <!-- END OF HEADER -->

    <div class="user-container">
        <h2>User Profile</h2>
        <div class="profile-info">
            <div class="user-details">
                <form action="user_faculty_profile_update.php" method="POST">
                    <div class="info-item">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                    </div>
                   
                    <div class="info-item">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                    </div>
                    <button type="submit" id="editBtn">Update Profile</button>
                </form>
            </div>
            <div class="profile-image">
                <img src="image/stud.png" alt="Profile Image">
            </div>
        </div>
    </div>
    <br><br><br><br>
    <!-- FOOTER -->
    <?php include 'footer.php'; ?>
    <!-- END OF FOOTER -->
</body>
</html>
