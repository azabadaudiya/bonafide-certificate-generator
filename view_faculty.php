<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEC Gandhinagar</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/view_faculty.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
     <!-- HEADER -->
     <?php
    include 'menu.php';
    ?>
    <!-- END OF HEADER -->
    <section class="mainbody">
        <div class="row">
            <div class="content">
                <img src="image/Dhaval parikh.jpg">
                <h3>Dr. Dhaval Parikh</h3>
                <h5>Head of Depertment</h5>

                <button class="information" id="new"> <a href="https://gecg28.ac.in/faculty/1" target="_blank"> Read
                        more</a></button>

            </div>
            <div class="content">
                <img src="image/yogendra tank.jpg">
                <h3>Prof. Yogendra Tank</h3>
                <h5>Assistant Professor</h5>
                <button class="information" id="new"> <a href="https://gecg28.ac.in/faculty/23" target="_blank"> Read
                        more</a></button>

            </div>
        </div>
        <div class="row">
            <div class="content">
                <img src="image/bijal.jpg">
                <h3>Prof. Bijal Gadhia</h3>
                <h5>Assistant Professor</h5>
                <button class="information" id="new"> <a href="https://gecg28.ac.in/faculty/15" target="_blank"> Read
                        more</a></button>

            </div>
            <div class="content">
                <img src="image/hemani shah.jpeg">
                <h3>Dr. Hemani Shah</h3>
                <h5>Assistant Professor</h5>
                <button class="information" id="new"> <a href="https://gecg28.ac.in/faculty/20" target="_blank"> Read
                        more</a></button>

            </div>
        </div>
    </section>
    
   
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