<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>

    <!-- Hero Image -->
    <div class="jumbotron text-center">

      <!-- Card image -->
      <div class="view overlay my-4">

          <!-- class="img-fluid" -->
        <img src="https://micksgym-iodv7bcgc4.stackpathdns.com/wp-content/uploads/2016/07/hiit-workout-header.jpg" class="img-fluid" alt="">
        <a href="#"></a>
      </div>

    <div class="container">
       <h1 class="h1-responsive font-weight-bold text-center my-5">Classes</h1>
        <p class="lead grey-text text-center w-responsive mx-auto mb-5">Perfect Form Fitness, where fitness and science combine. Our unique, creative classes are structured from the ground to give the absolutely best results and ensure you've got a good workout while also maintaining a fun engaging atmosphere. </p>

    </div>

     <!--Table-->   
    <div class="container">
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
          <div class="card mb-4">

            <!--Card image-->
            <div class="view overlay">
              <!--<img class="card-img-top" src="images/feature1.jpg" alt="Card image cap">-->
             <img  src= "https://cdn.pixabay.com/photo/2018/01/01/01/56/yoga-3053487_960_720.jpg" alt="" height="260" width="350">
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
                <a href="yogaclass.php" class="btn btn-info btn-md">Read more</a>

            </div>

          </div>
          <!-- Card -->

            <!-- Card -->
          <div class="card mb-4">

            <!--Card image-->
            <div class="view overlay">
              <!--<img class="card-img-top" src="images/feature1.jpg" alt="Card image cap">-->
             <img  src= "https://cdn.pixabay.com/photo/2017/04/25/20/18/sport-2260736_960_720.jpg" alt="" height="260" width="350">
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
              <a href="strengthclass.php" class="btn btn-info btn-md">Read more</a>

            </div>

          </div>
          <!-- Card -->

          <!-- Card -->
          <div class="card mb-4">

            <!--Card image-->
            <div class="view overlay">
              <!--<img class="card-img-top" src="images/feature1.jpg" alt="Card image cap">-->
             <img  src= "https://blog.nasm.org/wp-content/uploads/2017/05/201705_metabolic-conditioning.jpg" alt="" height="260" width="350">
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
              <a href="cardioclass.php" class="btn btn-info btn-md">Read more</a>

            </div>
          </div>
        </div>
      <!-- Card -->

    </div>    
<?php
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
