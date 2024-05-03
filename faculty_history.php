<?php
    include 'connection.php';
    session_start();
    if(!isset($_SESSION['sess_user'])){
        header("Location:login.php");
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEC Gandhinagar</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/faculty_history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    
</head>
<body>
 <!-- HEADER -->
 <?php
    include 'menu.php';
    ?>
    <!-- END OF HEADER -->

<div class="status-container">
<?php
     $query = "select * from application ORDER BY date DESC";
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
                if ($value['status'] == 'Approve') {
                    echo '<span style="color: green;">Approved</span>';
                } elseif ($value['status'] == 'Reject') {
                    echo '<span style="color: red;">REJECTED : ' . $value['reject_reason'] . '</span>';
                } 
                else{
                    echo '<span style="color: gray;">'.$value['status'].'</span>';;
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