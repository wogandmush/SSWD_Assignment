<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>


<div class="jumbotron" style="background-image: url(images/cardio/cardiohero.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
  <div class="text-white text-center py-5 px-4 my-5 font-bold">
    <div>
      <h1 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Cardio</strong></h1>
      <h4 class="mx-5 mb-5">The ultimate high-energy workout class that uses martial arts techniques inspired by Taekwondo, Kung Fu, Tai Chi and Karate.  </h4>
     <h4 class="mx-5 mb-5"> Increase your mobility and flexibility whilst burning calories and boosting metabolism in this fun-filled high energy class.</h4>
      
    </div>
  </div>
</div>

    
    
    <body>

        <!-- Section: Features v.2 -->
<section class="my-5">

  <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive font-weight-bold text-center my-5">What is Cardio?</h2>
  <!-- Section description font-weight-bolder-->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">This is a full body interval training programme that burns the maximum number of calories. It is suitable for people with a moderate fitness level and incorporates exercises such as high knees, march twists, upper cuts and knee-to-elbows. And you don’t need to have any prior experience in martial arts to join in.

Cardio class at Perfect Form Fitness is an alternative cardio exercise that teaches you how to kick, jab and clinch in a non-contact environment. It’s a fast paced class that keeps your heart racing and really makes you sweat. Classes can be quite intense so we recommend you take it at your own pace and build endurance over time.

At the end of each Cardio session you will leave exhausted but feeling great. Complete beginners will feel the burn for a few days after their first few sessions. This challenging mix of martial arts and cardio is a great way to unleash your inner strength! </p>
    </div>
    
     <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive font-weight-bold text-center my-5">What are the Benifits of Cardio Class</h2>
  <!-- Section description -->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">Our Perfect Form Fitness instructors will show you techniques to help burn fat. An hour Cardio class allows you to burn up to 1,000 calories. Although individual results vary depending on your fitness level, height and weight, it is a class that will certainly keep you on your toes.

This empowering cardio workout will also help you build muscle, improve balance and coordination. It will work your upper body, lower body and core. Toning your arms, abs and legs. It will also boost your energy levels and is a great way to de-stress.</p>
        
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
                    <h1 class="h1-reponsive text-white text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s"><strong>Cardio</strong></h1>
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
	$testimonials = Testimonial::loadApproved("cardio");
    include 'testimonial.php';
    ?>
   
    

</section>
<!-- Section: Features v.2 -->
        
        


    </body>    
        
<?php
#vv this should be the last line. body and html tags are closed
include_once 'footer.php';
?>
