<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>

<div class="jumbotron" style="background-image: url(images/class/classhero.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
  <div class="text-warning text-center py-5 px-4 my-5 font-bold">
    <div>
      <h1 class="text-light bg-dark card-title h1-responsive pt-3 mb-5 font-bold"><strong>Classes</strong></h1>
      <h4 class="text-light bg-dark mx-5 mb-5">Perfect Form Fitness, where fitness and science combine.  </h4>
     <h4 class="text-light bg-dark mx-5 mb-5"> Our unique, creative classes are structured from the ground to give the absolutely best results and ensure you've got a good workout while also maintaining a fun engaging atmosphere.</h4>
      
    </div>
  </div>
</div>

     <!--Table-->   
    <div class="container table-responsive">
      <div class="row">
        <div class="col-sm">
          <table class="table table-hover" id="tablePreview">
                <!--Table-->
            <!--Table head-->
              <thead class="thead-dark">
                <tr>
                  <th>Class Name</th>
                  <th>Monday</th>
                  <th>Tuesday</th>
                  <th>Wednesday</th>
                  <th>Thursday</th>
                  <th>Friday</th>
                  <th>Saturday</th>
                  <th>Sunday</th>
                </tr>
              </thead>
              <!--Table head-->
              <!--Table body-->
              <tbody>
                <tr>
                  <th scope="row">Yoga</th>
                  <td></td>
                  <td></td>
                  <td>12:00</td>
                  <td></td>
                  <td></td>
                  <td>16:00</td>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Strength</th>
                  <td></td>
                  <td>18:00</td>
                  <td></td>
                  <td>10:00</td>
                  <td></td>
                  <td>10:00</td>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Cardio</th>
                  <td>13:00</td>
                  <td>13:00</td>
                  <td></td>
                  <td>17:00</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr><br><br><br><br><br><br>
              </tbody>
      <!--Table body-->

    <!--Table-->
            </table>
        </div>
      </div>
    </div>


    <!--Gym Classes--> 
    <div class="container"><br><br><br><br><br><br>
        <!-- Card deck -->
        <div class="card-deck">

          <!-- Card -->
          <div class="card mb-4 text-center">

            <!--Card image-->
            <div class="view overlay text-center">
              <!--<img class="card-img-top" src="images/feature1.jpg" alt="Card image cap">-->
             <img  src= "images/yoga/yogacard2.jpg" alt="" height="260" width="350" class="img-fluid">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title">Yoga</h4>
              <!--Text-->
              <p class="card-text">Yoga Classes for all levels whether you're a vetern or beginner our classes will leave you feeling rejuvenated and stress free.</p>
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
              <div class = "text-center">
                <a href="<?php echo $root;?>/yogaclass.php" class="btn btn-info btn-md">Read more</a>
              </div>
            </div>

          </div>
          <!-- Card -->

            <!-- Card -->
          <div class="card mb-4 text-center">

            <!--Card image-->
            <div class="view overlay text-center">
              <!--<img class="card-img-top" src="images/feature1.jpg" alt="Card image cap">-->
             <img  src= "images/strength/strengthcard.jpg" alt="" height="260" width="350" class="img-fluid">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title">Strength</h4>
              <!--Text-->
              <p class="card-text">Strength Class is a brand new fitness class which will build your core strength and help prevent injury, imporve joint mobility and resilience</p>
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
              <div class = "text-center">
                <a href="<?php echo $root;?>/strengthclass.php" class="btn btn-info btn-md">Read more</a>
              </div>
            </div>

          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4 text-center">

            <!--Card image-->
            <div class="view overlay text-center">
              <!--<img class="card-img-top" src="images/feature1.jpg" alt="Card image cap">-->
             <img  src= "images/cardio/cardiocard.jpg" alt="" height="260" width="350" class="img-fluid">
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>

            <!--Card content-->
            <div class="card-body">

              <!--Title-->
              <h4 class="card-title">Cardio</h4>
              <!--Text-->
              <p class="card-text">Feel the burn with an intense cardio workout that'll leave you in much better shape and boost overall fitness levels. </p>
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
              <div class = "text-center">
                <a href="<?php echo $root;?>/cardioclass.php" class="btn btn-info btn-md">Read more</a>
              </div> 
            </div>
          </div>
        </div>
      <!-- Card -->

    </div>    
<?php
#vv this should be the last line. body and html tags are closed
include_once 'footer.php';
?>
