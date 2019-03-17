<?php

ini_set('display_errors', 1);
require '../config/connect.php';

	?>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Complete Form</title>
                <style type="text/css">
                    .error {
                        color:red;
                    }
                </style>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/materia/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        </head>
        <body>
       
                
                           
        </body>

        <?php
       
        $sql = "SELECT * FROM members";
if($result = mysqli_query($conn, $sql)){
   // print_r($result); 
    if(mysqli_num_rows($result)>0){
        echo "<table class='table table-stripped table-hover table-condensed table-bordered'>
                <tr>
                <th>user_no</th>
                <th>first_name</th>
                <th>last_name</th>
                <th>date_of_birth</th>
                <th>gender</th>
                <th>mobile</th>
                <th>home_tel</th>
                <th>email</th>
                <th>address</th>
                <th>membership</th>
                <th>password</th>         
                </tr>
        ";
        
//        $count = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
//            $count++;   
//            echo "<p>Row number: $count</p>";
//            print_r($row);
            echo "<tr>";
                echo "<td>" . $row["user_no"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["mobile"] . "</td>";
                echo "<td>" . $row["home_tel"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["membership"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
            echo "</tr>";
            
        }
        echo "</table>";
        //close the result set
        mysqli_free_result($result);
    }else{  
        ?>
        <h4>Error with the table</h4>
        <?php
    }
}else{
    echo "<p>Unable to excecute: $sql. " . mysqli_error($conn) ."</p>";   
}

?>

