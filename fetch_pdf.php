<?php
    // Include database connection
    include 'connection.php';

    // Fetch PDF data from database based on application ID
    $application_id = $_GET['application_id']; // Assuming you're passing application ID via GET method
    $query = "SELECT pdf FROM application WHERE application_id = '$application_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Fetch PDF binary data
        $row = mysqli_fetch_assoc($result);
        $pdfBinaryData = $row['pdf'];

        // Set appropriate headers for PDF content
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="document.pdf"'); // You can change the filename if needed

        // Output the PDF binary data directly
        echo $pdfBinaryData;
    } else {
        // Error fetching PDF data
        echo "Error fetching PDF data from database.";
    }
?>
