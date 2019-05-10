<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>

<!-- Hero Image -->
      <div class='section header' id="yoga_hero">
       <!-- [1] add image or h1 text to help us visualise our page design -->
       <!-- we will remover these later -->
       <!-- Placeholder for image -->
<!--
       <img src='images/index/barbell.png' alt="PerfectForm Fitness Logo" id="header_logo"/>
-->
       <div id="hero">
        <h1 class = "text-dark"> Yoga </h1>
        <p class = "text-dark"><br><em>Practicing Yoga Can Help You Live a Healthier and Happier Lifestyle</em></p>
      </div>
    </div>
    

     

        <!-- Section: Features v.2 -->
<section class="my-5">

  <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive text-info font-weight-bold text-center my-5">What is Yoga?</h2>
  <!-- Section description font-weight-bolder-->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">It is an exercise performed through a series of body postures and breathing exercises. There are a wide variety of styles that vary in difficulty level and speed however it is an exercise suitable for people of all ages and fitness abilities.

It can help you develop better balance and endurance. Yoga can also help you improve flexibility, strength and stamina. It has been proven to boost energy levels and improve mood.
As well as the physical benefits there are a number of other positive factors in practicing yoga. It has been proven to help reduce stress, improve sleep and lower blood pressure. It can also be a spiritual experience for practitioners. As it can give them the space to be peaceful and mindful.</p>
    </div>
    
     <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive text-info font-weight-bold text-center my-5">Perfect Form Fitness Yoga</h2>
  <!-- Section description -->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">Our yoga classes at Perfect Form Fitness is a place to quiet your mind and focus on you. In class you will perform warm-up stretches, breathing exercises, workout positions and a relaxation cool-down. Also, instructors will help you master your poses and teach you how to connect with your breath.</p>
    </div>
    
     <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive text-info font-weight-bold text-center my-5">Styles of Yoga</h2>
  <!-- Section description -->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">There are a variety of yoga styles, with a class to suit everyone’s abilities. Hatha yoga is a gentler style but can be quite challenging. Longer poses help to relieve tension in the body. As well as loosen your body and strengthen the muscles. In contrast, Vinyasa flow is a yoga style that moves at a faster pace focusing on the flow between the movements rather than individual poses. And Bikram yoga is a style suited to more experienced yogis. As this class takes place in a 42 °C heated studio. Therefore, it’s best to try out different styles before deciding which is right for you.</p>
       
        
    </div>
    
    
     <div class="view" style="background-image: url('images/yoga/signupyoga.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light align-items-center">
              <!-- Content -->
              <div class="container">
                <!--Grid row-->
                <div class="row">
                  <!--Grid column-->
                  
                  <div class="col-md-12 mb-4 white-text text-center">
                      <h3 class="text-dark display-3 font-weight-bold white-text mb-0 pt-md-5 pt-5">Sign Up Now</h3>
                    <h2 class="text-dark h1-reponsive text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s"><strong>Yoga</strong></h2>
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
	$testimonials = Testimonial::loadApproved("yoga");
    include 'testimonial.php';
    ?>
    




</section>
<!-- Section: Features v.2 -->
        
        


    </body>    
        
<?php
#vv this should be the last line. body and html tags are closed
include_once 'footer.php';
?>
