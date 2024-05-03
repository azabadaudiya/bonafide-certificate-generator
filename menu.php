<?php
    include 'connection.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
?>
<html>
<body>
<header>
        <div class="logo">
            <img src="image/gecg-logo.png" alt="gecg logo">
        </div>
        <div class="title">
            <h1>Government Engineering College, Gandhinagar</h1>
        </div>
    </header>
    <!-- END OF HEADER -->

    <!-- NAVBAR -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" id="checkbtn"><i class="fas fa-bars" onclick=showslidebar()></i></label>

        <ul class="slidebar">
            <li onclick=hideslidebar()><a href="#">
               </a></li>
            <li><a href="index.php">HOME</a></li>
            <li><a href="view_faculty.php">Faculty Profile</a></li>


        

<li id="content-mobile">
                <a href="#">Bonafide Application</a>
                <ul id="dropdown-products-mobile">
                    <li><a href="user_apply_bonafide.php">Apply for Bonafide Certificate</a></li>
                    <li><a href="user_curr_past_app.php">Current and Past Application</a></li>
                    <li><a href="user_application_status.php">Application Status</a><br></li>
                </ul>
            </li>

  

<li id="content-mobile">
                <a href="#">Bonafide Application</a>
                <ul id="dropdown-products-mobile">
                    <li><a href="user_apply_bonafide.php">Apply for Bonafide Certificate</a></li>
                    <li><a href="user_curr_past_app.php">Current and Past Application</a></li>
                    <li><a href="user_application_status.php">Application Status</a><br></li>
                </ul>
            </li>
            

            <li id="content-mobile">
                <a href="#">Bonafide Approval</a>
                <ul id="dropdown-products-mobile">
                    <li><a href="approval_page.php">Approve Request</a></li>
                    <li><a href="faculty_history.php">History</a></li>
                     </ul>
            </li>


            <?php
            if(!isset($_SESSION['sess_user'])) {
            ?>
            <li id="static"><a href="login.php">Login</a></li>
            <?php
                
            }
            else{
                ?>
            <li id="content-mobile">
                <a href="#">User</a>
                <ul id="dropdown-products-mobile">
                    <li><a href="user_faculty_profile_update.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
            <?php }
            ?>
        </ul>

 <ul class="menubar">
    <li><a href="index.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a></li>
    <li class="hideOnMobile"><a href="view_faculty.php">Faculty Profile</a></li>

    <?php if (isset($_SESSION['sess_user'])) {
        $teacher = $_SESSION['sess_user'];
        $qry1 = "SELECT * FROM login WHERE email='$teacher' AND ROLE=0";
        $result = mysqli_query($con, $qry1);

        if ($result && mysqli_num_rows($result) > 0) {
    ?>
            <li class="hideOnMobile" id="content-pc">
                <a href="#">Bonafide Approval</a>
                <ul id="dropdown-products-pc">
                    <li><a href="approval_page.php">Approve Request</a></li>
                    <li><a href="faculty_history.php">History</a></li>
                </ul>
            </li>
    <?php } else { ?>
            <li class="hideOnMobile" id="content-pc">
                <a href="#">Bonafide Application</a>
                <ul id="dropdown-products-pc">
                    <li><a href="user_apply_bonafide.php">Apply for Bonafide Certificate</a></li>
                    <li><a href="user_curr_past_app.php">Current and Past Application</a></li>
                    <li><a href="user_application_status.php">Application Status</a></li>
                </ul>
            </li>
    <?php } ?>
    <?php } else { ?>
        <li class="hideOnMobile" id="content-pc">
            <a href="#">Bonafide Application</a>
            <ul id="dropdown-products-pc">
                <li><a href="user_apply_bonafide.php">Apply for Bonafide Certificate</a></li>
                <li><a href="user_curr_past_app.php">Current and Past Application</a></li>
                <li><a href="user_application_status.php">Application Status</a></li>
            </ul>
        </li>
    <?php } ?>


    <?php
if (!isset($_SESSION['sess_user'])) {
?>
    <li class="hideOnMobile"><a href="login.php">Login</a></li>
<?php
} else {
    $email = $_SESSION['sess_user'];
    $q = "SELECT * FROM login WHERE email='$email'";
    $r = mysqli_query($con, $q);
    while ($v = mysqli_fetch_array($r)) {
?>
        <li class="hideOnMobile" id="content-pc">
            <a href="#">Welcome <?php echo $v['name']; ?></a>
            <ul id="dropdown-products-pc">
                <li><a href="user_faculty_profile_update.php"><i class="fa-regular fa-user"></i>&nbsp; Profile</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp; Logout</a></li>
            </ul>
        </li>
<?php
    }
}
?>


            
            <li class="menubutton" onclick=showslidebar()><a href="#">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> -->
            </a></li>
        </ul>
    </nav>

    <!-- END OF NAVBAR -->
</body>
</html>
