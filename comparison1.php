<html>
<head>
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

  echo '<h1>PCRM Result Comparison</h1><pre>';
  ?>
  <!-- <div align="left">
     <button name="create_excel" id="create_excel" class="btn btn-success">Create Excel File</button>
  </div> -->
  <?php
  //if ( $xlsx = SimpleXLSX::parse('PCRM Result Comparison.xlsx') ) {
  //?>
  <div id="pcrm">
  <table>
    <tbody>
        <?php
            ini_set('max_execution_time', 60000);
             
             $get = 'SELECT * FROM  tnb2';
             $result = mysqli_query($link,$get);
             $equip = array();
             if(mysqli_num_rows($result)>0)
             {
              while($row = mysqli_fetch_array($result))
              {
                 $equip[]=$row["equipment"];
                 $nometer[]=$row["no_meter"];
                 $alamat[]=$row["alamat"]; 
              }
              $equiplength=mysqli_num_rows($result);

              }
            for($i=0;$i<$equiplength;$i++)
             {
              for($x=0;$x<$equiplength;$x++)
              {
                if (substr($equip[$i],-4)==substr($nometer[$x],-4)) {
                  $metermatching = $nometer[$x];
                  $alamatmatching = $alamat[$x];
                  $matching = true;
                  break;
                }
                else
                {
                  $matching = false;
                }
              }
              if($matching)
              {
                $update_status = "UPDATE tnb2 SET status='Match', no_meter='".$metermatching."', alamat='".$alamatmatching."' WHERE equipment='".$equip[$i]."'";
                $queryUpdate = mysqli_query($link,$update_status);
                echo $update_status;
                echo "<br>";
              }
                
             }
               mysqli_close($link);     
             }
          ?>
        </tbody>
    </table>
    </div>
</body>
</html>
