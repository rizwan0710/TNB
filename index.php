<html>
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

  include "SimpleXLSX.php";

  echo '<h1>PCRM Result Comparison</h1><pre>';
  ?>
  <!-- <div align="left">
     <button name="create_excel" id="create_excel" class="btn btn-success">Create Excel File</button>
  </div> -->
  <?php
  if ( $xlsx = SimpleXLSX::parse('PCRM Result Comparison.xlsx') ) {
  ?>
  <div id="pcrm">
  <table>
    <tbody>
        <?php
          // echo '<table id=pcrm><tbody>';
          $i = 0;
          $x = 0;
          foreach ($xlsx->rows() as $elt) {
            foreach ($xlsx->rows() as $elt2) {
          
              if ($i == 0) {
                echo "<tr><th>Bil</th><th>" . $elt[0] . "</th><th>" . $elt[1] . "</th><th>Match/Unmatch</th></tr>"; //for table header
              }
              else
              {

                 if(substr($elt[1],-8)==substr($elt2[0],-8))
                {
                  $x++;
                  echo "<tr><td><b>".$x."</b></td><td><b>" . $elt2[0] . "</b></td><td><b>" . $elt[1] . "</b></td><td><b>Match</b></td></tr>";
                }
              }
              $i++;
            }

            if($elt[0]!=$elt[1])
            {
              echo "<tr><td>--</td><td>" . $elt[0] . "</td><td>" . $elt[1] . "</td><td>Unmatch</td></tr>";
            }
          }

          // echo "</tbody></table>";
          ?>
        </tbody>
    </table>
    </div>
    <?php

  } else {
    echo SimpleXLSX::parseError();
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
