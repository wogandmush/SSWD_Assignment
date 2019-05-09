<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>

<!-- Hero Image -->
      <div class='section header' id="strength_hero">
       <!-- [1] add image or h1 text to help us visualise our page design -->
       <!-- we will remover these later -->
       <!-- Placeholder for image -->
<!--
       <img src='images/index/barbell.png' alt="PerfectForm Fitness Logo" id="header_logo"/>
-->
       <div id="hero">
        <h1 class = "text-light"> Strength </h1>
        <p><br><em>Keep fit and Future Proof your Body with Mobility</em></p>
      </div>
    </div>

<!--
    <div class="hero-image strength-header">
  <div class="hero-text">
    <h1>Strength</h1>
    <p>Keep fit and future proof your body with mobility, weights and bodyweight exercises. Strength Class is designed to meet the needs of those who are over 50.</p>
    <button>Hire me</button>
  </div>
</div> -->
    

    <body>

        <!-- Section: Features v.2 -->
<section class="my-5">

  <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive font-weight-bold text-center my-5">What is Strength Class?</h2>
  <!-- Section description font-weight-bolder-->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">As we age, it is critical to stay active. We should listen to the needs and abilities of our bodies, to reduce the risk of injury or strain. You will work with trained Perfect Form Fitness instructors, who can modify exercises to suit your individual needs and fitness abilities.

Also, Strength class is for anyone who is looking for an exercise that is fun, friendly and supportive. you will use your own body weight as well as kettlebells and dumbbells. Each class has a different focus, helping target problem areas as needed. </p>
    </div>
    
     <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive font-weight-bold text-center my-5">What are the Benifits of Strength Class</h2>
  <!-- Section description -->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">While most older adults regularly walk, swim or run for exercise many do not perform weight or resistance training. Strength class will help you build muscle, increase mobility and improve bone density. All of which are important areas to focus on as we age.

You can achieve better balance and reduce the risk of injury or strain through resistance training.  Instructors will work with members to modify exercises as required and ensure they meet individual needs. Each week you will feel stronger and build endurance, enabling you to perform other aerobic activities.

Strength Class is an enjoyable class. With a friendly atmosphere led by enthusiastic instructors. Moreover, it’s a great way to meet new people and socialise. You can easily chat and interact with other class members, helping each other to stay motivated.</p>
        
    </div>
    
         <div class="view" style="background-image: url('images/strength/signupstrength.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light align-items-center">
              <!-- Content -->
              <div class="container">
                <!--Grid row-->
                <div class="row">
                  <!--Grid column-->
                  
                  <div class="col-md-12 mb-4 white-text text-center">
                      <h3 class="text-white display-3 font-weight-bold white-text mb-0 pt-md-5 pt-5">Sign Up Now</h3>
                    <h2 class="h1-reponsive text-white text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s"><strong>Strength</strong></h2>
                    <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                    <a href="<?php echo $root;?>/register.php" class="btn btn-danger btn-md">
                      Sign Up
                     </a>
                   
                  </div>
                  <!--Grid column-->
                </div>
                <!--Grid row-->
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
    
    
   <?php
	$testimonials = Testimonial::loadApproved("strength");
    include 'testimonial.php';
    ?>
    
   
    

</section>
<!-- Section: Features v.2 -->
        
        


    </body>    
        
<?php
#vv this should be the last line. body and html tags are closed
include_once 'footer.php';
?>


