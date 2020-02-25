<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tnb900";

 //Create connection

$link= mysqli_connect($servername, $username, $password,$database);
if(!$link)
    {
      die ("could not connect :".mysqli_connect_error($link));
    }
   
    else
    {
      ?>
<?php
                $get = "select equipment as equipment_tnb, no_meter as meter ,alamat as address from  tnb2 where status IS NULL";
                $result = mysqli_query($link,$get);


               

                  while($row = mysqli_fetch_array($result))
                  {
                    $data[]=$row;
                  }
                 echo(json_encode($data));

              
               

          
                  
                mysqli_free_result($result);
                 // echo(json_encode($data));
              }
        
      ?>
