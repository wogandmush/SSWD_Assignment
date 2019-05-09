<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>

<!-- Hero Image -->
      <div class='section header' id="class_hero">
       <!-- [1] add image or h1 text to help us visualise our page design -->
       <!-- we will remover these later -->
       <!-- Placeholder for image -->
<!--
       <img src='images/index/barbell.png' alt="PerfectForm Fitness Logo" id="header_logo"/>
-->
       <div id="hero">
        <h1 class = "text-light"> Classes </h1>
        <p><br><em>Where Fitness and Science Combine</em></p>
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


<?php
include 'classdeck.php';
include 'footer.php';
?>
