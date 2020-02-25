<html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tnb900";

// Create connection
$link= mysqli_connect($servername, $username, $password,$database);
if(!$link)
    {
      die ("could not connect :".mysqli_connect_error($link));
    }
    // else
    // {
    //   $queryget = "select * from tnb ";
    //   $resultget= mysqli_querry($link,$queryget);
    // }
    // if(!$resultget)
    // {
    //   die("Invalid Querry - get Item List :".mysqli_error($link));
    // }
    else
    {
?>
<head>
<style type="text/css">
  td,th {
    border: 1px solid rgb(190, 190, 190);
    padding: 10px;
  }

  td {
    text-align: center;
  }

  tr:nth-child(even) {
    background-color: #eee;
  }

  table {
    border-collapse: collapse;
    border: 2px solid rgb(200, 200, 200);
    letter-spacing: 1px;
    font-family: sans-serif;
    font-size: .7rem;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

<?php

ini_set('error_reporting', E_ALL);
ini_set('memory_limit',-1);
ini_set('max_execution_time', '0'); 
  include "SimpleXLSX.php";

  echo '<h1>PCRM Result Comparison</h1><pre>';
  ?>
  <!-- <div align="left">
     <button name="create_excel" id="create_excel" class="btn btn-success">Create Excel File</button>
  </div> -->
  <?php
  if ( $xlsx = SimpleXLSX::parse('PCRM900 Result .xlsx') ) {
  ?>
  <div id="pcrm">
  <table>
    <tbody>
        <?php
          // echo '<table id=pcrm><tbody>';
        $i=0;
          foreach ($xlsx->rows() as $elt) {
            $result = preg_replace("/'/", ' ',$elt[2]);
            echo $result."<br>";
             $get= "INSERT INTO `tnb2`(`equipment`, `no_meter`,  `alamat`) VALUES ('".$elt[0]."','".$elt[1]."','".$result."')";


             if (mysqli_query($link, $get)) 
             {
                echo "New record created successfully";
                echo "<br>";
                } else {
                    echo "Error: " . $get . "<br>" . mysqli_error($link);
                }

          }
                          mysqli_close($link);

          // echo "</tbody></table>";
          ?>
        </tbody>
    </table>
    </div>
    <?php

  } else {
    echo SimpleXLSX::parseError();
  }
}
?>

</body>
<!-- <script>
 $(document).ready(function(){
      $('#create_excel').click(function(){
           var excel_data = $('#pcrm').html();
           var page = "excel.php?data=" + excel_data;
           window.location = page;
      });
 });
 </script> -->
</html>
