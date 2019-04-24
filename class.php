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


<?php
include 'classdeck.php';
include 'footer.php';
?>
