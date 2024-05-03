<?php
    include 'connection.php';
    session_start();
    if(!isset($_SESSION['sess_user'])){
        header("Location:login.php");
    }
    else{
        $email=$_SESSION['sess_user'];
        $q1="SELECT id, email,enrollment_no,department from login where email='$email'";
        $r1=mysqli_query($con,$q1);
        $v1=mysqli_fetch_array($r1);
        $sid=$v1['id'];
        $semail=$v1['email'];
        $senroll=$v1['enrollment_no'];
        $sdept=$v1['department'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEC Gandhinagar</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/user_apply_bonafide.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body>
   <!-- HEADER -->
   <?php
    include 'menu.php';
    ?>
    <!-- END OF HEADER -->
    <div class="form-container">
        <div class="input-container">
            <form action="user_apply_bonafide.php" method="post" enctype="multipart/form-data">
                <h2 align="center">APPLICATION FOR BONAFIDE CERTIFICATE</h2><br>
                Enter Your Name: <input type="text" name="student_name" placeholder="Enter your name" required><br>
                Enter Your Semester: <input type="number" name="sem" placeholder="Enter your semester" required><br>
                Enter Your Purpose : <textarea cols="5" rows="5" placeholder="Enter Purpose" name="purpose" required></textarea><br>
                Upload Your Image : <input type="file" alt="" name="stu_image" accept="image/jpeg, image/png" required><br>
                Upload Your Signature: <input type="file" alt="" name="stu_sign" accept="image/jpeg, image/png" required><br>
                <button>Submit Application</button>
                <!-- date will be inserted dynamically -->
            </form>
        </div>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_name = $_POST['student_name'];
            // $enroll= $_POST['enroll'];
            // $dept= $_POST['dept'];
            $sem= $_POST['sem'];
            $purpose= $_POST['purpose'];
            $status= "PENDING";

            $fn1 = $_FILES["stu_image"]["name"];
            $tn1=$_FILES["stu_image"]["tmp_name"];
            date_default_timezone_set("Asia/Calcutta");
            $iname1 = (string)(date('YmdHis'));
            $e1=pathinfo($fn1,PATHINFO_EXTENSION);
            $ip1 = $iname1.".".$e1;
            if($fn1){
                move_uploaded_file($_FILES['stu_image']['tmp_name'],"img_uploads/".$ip1);
            }

            $fn2 = $_FILES["stu_sign"]["name"];
            $tn2=$_FILES["stu_sign"]["tmp_name"];
            date_default_timezone_set("Asia/Calcutta");
            $iname2 = (string)(date('YmdHis'));
            $e2=pathinfo($fn2,PATHINFO_EXTENSION);
            $ip2 = $iname2.".".$e2;
            if($fn2){
                move_uploaded_file($_FILES['stu_sign']['tmp_name'],"sign_uploads/".$ip2);
            }
            $submittedAt = date('Y-m-d H:i:s');

            $query = "insert into application(stud_id,name,enrollment,branch,semester,email,purpose,student_image,signature,date,status) 
            values('$sid','$student_name','$senroll','$sdept','$sem','$semail','$purpose','$ip1','$ip2','$submittedAt','$status')";
            $sql = mysqli_query($con,$query);
            if($sql){
                echo "<script>alert('Application Submitted')</script>";
            }
            else{
                echo "<script>alert('error')</script>";
            }

        }
    ?>

    <!-- FOOTER -->
    <?php
    include 'footer.php';
    ?>
    <!-- END OF FOOTER -->
</body>

</html>
<?php
}
?>