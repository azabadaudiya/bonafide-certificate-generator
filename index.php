<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEC Gandhinagar</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <!-- HEADER -->
    <?php
    include 'menu.php';
    ?>
    <!-- END OF HEADER -->
    <!-- BODY -->
    <main>
        <div class="clg">
            <img src="image/campus.jpg" alt="College">
        </div>
          
        <div class="para">
            <div class="container">
            <p>Established in 2004, Government Engineering College, Gandhinagar (GEC-Gn) takes pride in 
                its highly motivated students. Our students are life-long assets that help this institute 
                to continuously evolve and work towards its Vision. Approved by AICTE. The College is 
                administrated by Directorate of Technical Education, Gujarat State, Gandhinagar. GEC Gn 
                is affiliated to Gujarat Technological University. GEC-Gn offers its students a wide range of 
                courses to choose from. This helps them to become multi-skilled personalities</p>
        </div>
    </div>
        <div class="para">
            <div class="container">
            <p>A bonafide certificate is an official document issued by an educational institution 
                or organization to certify the authenticity of a person's identity and their association 
                with the institution. It serves as proof that the individual is a genuine student or 
                employee of the organization.The certificate typically contains relevant information 
                such as the person’s name, date of birth, course or employment details, duration of 
                association with the institution, and any other specific details required by the issuing 
                authority.</p>
        </div>
    </div>
    </main>
    <!-- END OF BODY -->

    <!-- FOOTER -->
    <?php
    include 'footer.php';
    ?>
    <!-- END OF FOOTER -->
    <script>
        function showslidebar(){
            const slidebar = document.querySelector('.slidebar')
            slidebar.style.display = 'flex'
        }
        function hideslidebar(){
            const slidebar = document.querySelector('.slidebar')
            slidebar.style.display = 'none'
        }
    </script>
</body>
</html>