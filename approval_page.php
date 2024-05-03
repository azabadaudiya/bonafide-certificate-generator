<?php
    include 'connection.php';
    session_start();
    if(!isset($_SESSION['sess_user'])){
        header("Location:login.php");
        exit(); // Make sure to exit after redirecting
    }
    else {
        
?>

<!-- Rest of your HTML code -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEC Gandhinagar</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/approval_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        .td{
            max-width: 200px; 
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative; 
        }

        .td:hover::after {
    content: attr(data-tooltip); 
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    border: 1px solid black;
    padding: 5px;
    white-space: normal; 
    z-index: 9999;
}

.details-button{
    background-color:#060E40;
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
  color: white;
}

.details-button:hover {
  background-color: #2e3c94; 
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
    <div class="form-container">
    <form action="" method="POST">
        Enrollment ID: &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="number" id="enrollmentId" name="enrollmentId" value="<?php if(isset($_POST['enrollmentId'])){echo $_POST['enrollmentId'];} ?>" required><br>
        Select Semester:
        <select id="semester" name="semester">
            <option value="">-- Select Semester --</option>
            <?php 
                $semesters = array(1, 2, 3, 4, 5, 6, 7, 8);
                foreach ($semesters as $sem) {
                    $selected = (isset($_POST['semester']) && $_POST['semester'] == $sem) ? 'selected' : '';
                    echo "<option value='$sem' $selected>$sem</option>";
                }
            ?>
        </select><br>
       
        <button type="submit">Search</button>
    </form>
</div>
    <br>
    <?php
     $query = "SELECT * FROM application WHERE status != 'Reject' AND status != 'Approve'";

     // Filter by enrollment ID
     if(isset($_POST['enrollmentId']) && !empty($_POST['enrollmentId'])) {
         $enrollmentId = $_POST['enrollmentId'];
         $query .= " AND enrollment = '$enrollmentId'";
     }

     // Filter by semester
     if(isset($_POST['semester']) && !empty($_POST['semester'])) {
         $semester = $_POST['semester'];
         $query .= " AND semester = '$semester'";
     }

     $query .= " ORDER BY date DESC";

     $result = mysqli_query($con, $query);
     if(mysqli_num_rows($result) > 0) {
    ?>
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
                <th>Details</th>
                <th>Approve</th>
                <th>Reject</th>
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
                <td class="purpose" data-tooltip="<?php echo htmlspecialchars($value['purpose']); ?>"><?php echo $value['purpose']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($value['date'])); ?></td>
                <td><button class="details-button" onclick="openPdf('<?php echo $value['application_id'];?>')">View Details</button></td>

                <td>
                <form method="POST" action="approve.php">
                    <button type="submit" class="approve-button" name="approve_button" value="<?php echo $value['application_id']; ?>">Approve</button>
                </form>
                </td>

                <td><button onclick="openPopup('<?php echo $value['application_id'];?>')" class="reject-button">Reject</button></td>
           
             
                <div id="popup" class="popup">
                    <div class="popup-content">
                        <span class="close" onclick="closePopup()">&times;</span>
                        <form id="popup-form" method="post" action="reject_application.php">
                            <textarea id="user-input" name="reason" placeholder="Write an appropriate reason" required></textarea>
                            <input type="hidden" name="application_id" id="application_id" value="<?php echo $value['application_id']; ?>">
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </tr>
            <?php 
           
        }
    }
    else {
        echo "<b>No applications found</b>";
    }
        ?>
        </tbody>
    </table>
    <script>
       function openPopup(applicationId) {
    document.getElementById("popup").style.display = "block";
    document.getElementById("application_id").value = applicationId; // Corrected variable name
}
        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        function openPdf(application_id) {
    window.open('view_certificate.php?application_id=' + application_id, '_blank', 'toolbar=0,location=0,menubar=0');
}
    </script>
</div>
</div>
   
   
</body>
</html>
<?php
}


?>
