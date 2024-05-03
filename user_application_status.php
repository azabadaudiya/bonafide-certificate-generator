<?php
    include 'connection.php';
    session_start();
    if(!isset($_SESSION['sess_user'])){
        header("Location:login.php");
    }
    else{
        $email=$_SESSION['sess_user'];
        $q1="SELECT id, email from login where email='$email'";
        $r1=mysqli_query($con,$q1);
        $v1=mysqli_fetch_array($r1);
        $sid=$v1['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEC Gandhinagar</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/user_application_status.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        .pdf-link {
    
    display: inline-block;
  width: 150px; /* Adjust width as needed */
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-family: sans-serif;
  font-size: 16px;
  text-align: center;
  transition: background-color 0.3s;
  background-color:#1f7a1f;
  color: white;
  text-decoration:none;
}

.pdf-link:hover {
    background-color: #145214;
}


    </style>
</head>
<body>
    
<!-- HEADER -->
<?php
    include 'menu.php';
    ?>
    <!-- END OF HEADER -->
<div class="status-container">
    <?php
     $query = "select * from application where stud_id='$sid' ORDER BY date desc";
     $result = mysqli_query($con,$query);
     if(mysqli_num_rows($result) > 0) {
    ?>
    <br>
    <div class="table-container">
    <table border="1">
        <thead>
            <tr>
                <th>Enrollment</th>
                <th>Name</th>
                <th>Branch</th>
                <th>Semester</th>
                <th>Email</th>
                <th>Purpose</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            
        </thead>
        <tbody>
        <?php
            while($value = mysqli_fetch_array($result)){
        ?>
        
            <tr>
                <td><?php echo $value['enrollment'] ?></td>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['branch'] ?></td>
                <td><?php echo $value['semester'] ?></td>
                <td><?php echo $value['email'] ?></td>
                <td><?php echo $value['purpose'] ?></td>
                <td><?php echo date('d/m/Y', strtotime($value['date'])); ?></td>
                <td>
                <?php
                    if ($value['status'] == 'Approve' && !empty($value['pdf'])) {
                        // Display the PDF using an iframe wrapped in a link
                        echo '<a href="fetch_pdf.php?application_id=' . $value['application_id'] . '" target="_blank" class="pdf-link"><i class="fa-solid fa-download" style="color: #ffffff;"></i>&nbsp;Download </a>';
                    } elseif ($value['status'] == 'Reject') {
                        // Display the reject reason in red color
                        echo '<span style="color: red;">REJECTED : ' . $value['reject_reason'] . '</span>';
                    } else {
                        // Display the status in gray color
                        echo '<span style="color: gray;">' . $value['status'] . '</span>';
                    }
                    ?>


                </td>
            </tr>
        
        <?php 
        }
    }
    else {
        echo "<b>no application</b>";
    }
        ?>
        </tbody>
    </table>
</div>
</div>

</body>
</html>
<?php
}
?>