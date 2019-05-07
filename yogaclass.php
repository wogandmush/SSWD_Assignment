<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>


<div class="jumbotron" style="background-image: url(images/yoga/yogahero.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
  <div class="text-black text-center py-5 px-4 my-5 font-bold">
    <div>
      <h1 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Yoga</strong></h1>
      <h4 class="mx-5 mb-5">Practicing yoga can help you live a healthier and happier lifestyle. It is a spiritual and physical practice that was first developed by the Indus-Sarasvati civilisation in India over 5,000 years ago. </h4>
     <h4 class="mx-5 mb-5"> Yoga class at Perform Fitness is an exercise that focuses on varied muscle groups.</h4>
      
    </div>
  </div>
</div>

     

        <!-- Section: Features v.2 -->
<section class="my-5">

  <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive font-weight-bold text-center my-5">What is Yoga?</h2>
  <!-- Section description font-weight-bolder-->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">It is an exercise performed through a series of body postures and breathing exercises. There are a wide variety of styles that vary in difficulty level and speed however it is an exercise suitable for people of all ages and fitness abilities.

It can help you develop better balance and endurance. Yoga can also help you improve flexibility, strength and stamina. It has been proven to boost energy levels and improve mood.
As well as the physical benefits there are a number of other positive factors in practicing yoga. It has been proven to help reduce stress, improve sleep and lower blood pressure. It can also be a spiritual experience for practitioners. As it can give them the space to be peaceful and mindful.</p>
    </div>
    
     <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive font-weight-bold text-center my-5">Perfect Form Fitness Yoga</h2>
  <!-- Section description -->
  <p class="lead grey-text text-center w-responsive mx-auto mb-5">Our yoga classes at Perfect Form Fitness is a place to quiet your mind and focus on you. In class you will perform warm-up stretches, breathing exercises, workout positions and a relaxation cool-down. Also, instructors will help you master your poses and teach you how to connect with your breath.</p>
    </div>
    
     <!-- Section heading -->
    <div class="container">
  <h2 class="h1-responsive font-weight-bold text-center my-5">Styles of Yoga</h2>
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
                      <h3 class="text-white display-3 font-weight-bold white-text mb-0 pt-md-5 pt-5">Sign Up Now</h3>
                    <h1 class="h1-reponsive text-white text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s"><strong>Yoga</strong></h1>
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
