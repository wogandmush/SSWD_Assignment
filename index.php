<?php
include 'header.php';
#^^this should be the first line of the file. Body tags are already opened

?>
    <!-- Hero Image -->
      <div class='section header' id="index_hero">
       <!-- [1] add image or h1 text to help us visualise our page design -->
       <!-- we will remover these later -->
       <!-- Placeholder for image -->
       <img src='images/index/barbell.png' alt="PerfectForm Fitness Logo" id="header_logo"/>
       <div id="hero">
        <h1> PerfectForm Fitness </h1>
        <p><br><em>Fitness Training That Delivers Results</em></p>
      </div>
    </div>
    <!--?php
    #Draw down from the admin-uploaded components, the two features from the featured table with id = 1 and 2
    #Development Team Note: use cloud9 for verifying function not local WAMP DB table
    $features = Feature::getFeatured(); // use the getFeatured()method from the Feature class to read those features tagged for display
    foreach($features as $feature){
      $feature->render(); // uses render() component to
    }
    ?>-->

    <div class="container">
      <?php
      #Draw down from the admin-uploaded components, the two features from the featured table with id = 1 and 2
      #Development Team Note: use cloud9 for verifying function not local WAMP DB table
      $features = Feature::getFeatured(); // use the getFeatured()method from the Feature class to read those features tagged for display
      foreach($features as $feature){
        $feature->render(); // uses render() component to
      }

      include 'classdeck.php';
      include 'testimonal.php';
      include 'fees.php';
      #^^this should be the first line of the file. Body tags are already opened

      ?>
    </div>

<?php
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
