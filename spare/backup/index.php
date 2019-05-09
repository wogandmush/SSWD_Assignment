<?php 
include 'header.php';
require '../config/connect.php'; ?>

<?php
// if the user is logged in
if(isset($_SESSION['user_no'])) {
    // if the users membership is Student Monthly display Student Monthly Content
     if($_SESSION['membership'] == 'Student Monthly') {
        ?>
        <section>
            <h2>Student Monthly Content</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae doloribus esse itaque necessitatibus nobis placeat repellat temporibus voluptas. Architecto maxime quisquam soluta veniam? Aliquid consequuntur cum eligendi enim, natus non!</p>
            <p>Accusamus animi architecto asperiores aspernatur at dolor eaque error est illum ipsam libero nam nemo nisi, officiis pariatur quae quidem quod sed sunt totam velit veniam vero voluptas voluptatem voluptatibus?</p>
        </section>
 
    <?php
     }
     elseif ($_SESSION['membership'] == 'Adult Monthly') { ?>
        <section>
            <h2>Adult Monthly Content</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae doloribus esse itaque necessitatibus nobis placeat repellat temporibus voluptas. Architecto maxime quisquam soluta veniam? Aliquid consequuntur cum eligendi enim, natus non!</p>
            <p>Accusamus animi architecto asperiores aspernatur at dolor eaque error est illum ipsam libero nam nemo nisi, officiis pariatur quae quidem quod sed sunt totam velit veniam vero voluptas voluptatem voluptatibus?</p>
        </section> 
            <?php
     }
     elseif ($_SESSION['membership'] == 'Adult Yearly') { ?>
         <section>
            <h2>Adult Yearly Content</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae doloribus esse itaque necessitatibus nobis placeat repellat temporibus voluptas. Architecto maxime quisquam soluta veniam? Aliquid consequuntur cum eligendi enim, natus non!</p>
            <p>Accusamus animi architecto asperiores aspernatur at dolor eaque error est illum ipsam libero nam nemo nisi, officiis pariatur quae quidem quod sed sunt totam velit veniam vero voluptas voluptatem voluptatibus?</p>
        </section> <?php
     }
    elseif ($_SESSION['membership'] == 'Admin') { ?>
         <section>
            <h2>Admin Content</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae doloribus esse itaque necessitatibus nobis placeat repellat temporibus voluptas. Architecto maxime quisquam soluta veniam? Aliquid consequuntur cum eligendi enim, natus non!</p>
            <p>Accusamus animi architecto asperiores aspernatur at dolor eaque error est illum ipsam libero nam nemo nisi, officiis pariatur quae quidem quod sed sunt totam velit veniam vero voluptas voluptatem voluptatibus?</p>
        </section> <?php
     }
 }
 
 ?>




















<?php
include 'footer.php';
?>
