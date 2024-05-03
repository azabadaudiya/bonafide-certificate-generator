<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $application_id = $_POST['application_id']; 
    $reason = $_POST['reason'];

    $query = "UPDATE application SET reject_reason = '$reason', status='Reject' WHERE application_id = '$application_id'";

    $result = mysqli_query($con, $query);

     if ($result) {
        echo "<script>alert('APPLICATION REJECTED')</script>";
        header("Location:approval_page.php");
    } else {
        echo "<script>alert('NOT REJECTED')</script>";
    }
} else {
   
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
