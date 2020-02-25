<html>
<head>
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
  /*td,th {
    border: 1px solid rgb(190, 190, 190);
    padding: 10px;
  }

  td {
    text-align: center;
  }

  tr:nth-child(even) {
    background-color: #eee;
  }*/

  /*example-table {
    border-collapse: collapse;
    border: 2px solid rgb(200, 200, 200);
    letter-spacing: 1px;
    font-family: sans-serif;
    font-size: .7rem;
  }*/
  #example-table-aa{
    background-color:black;
    border: 1px solid #333;
    border-radius: 10px;
}

/*Theme the header*/
#example-table.tabulator-header {
    background-color:#333;
    color:#fff;
}

/*Allow column header names to wrap lines*/
#example-table-aa .tabulator-header .tabulator-col,
#example-table-aa .tabulator-header .tabulator-col-row-handle {
    white-space: normal;
}

/*Color the table rows*/
#example-table-aa .tabulator-tableHolder .tabulator-table .tabulator-row{
    color:#fff;
    background-color: #666;
}

/*Color even rows*/
    #example-table-aa .tabulator-tableHolder .tabulator-table .tabulator-row:nth-child(even) {
    background-color: #444;
}
#button{
    background-color:grey;
    color:white;
    height:30px;
    width:100px;
    border: 1px solid #333;
    border-radius: 10px;

}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link href="https://unpkg.com/tabulator-tables@4.5.3/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.5.3/dist/js/tabulator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
</head>
<body>
<center>
<h1>PCRM RESULT COMPARISON(MATCH)</h1><pre>
</center>
<?php
    ini_set('error_reporting', E_ALL);
ini_set('memory_limit',-1);

  ?>
  <!-- <div align="left">
     <button name="create_excel" id="create_excel" class="btn btn-success">Create Excel File</button>
  </div> -->
  <?php
  //if ( $xlsx = SimpleXLSX::parse('PCRM Result Comparison.xlsx') ) {
  //?>
  <div id="example-table-aa"></div>
  <br>
   <center>
  <button id="button" type="submit" form="form1" value="convert-excel" id="download-csv" >Convert-excel</button>
  </center>

  <!-- <table> -->
    <!-- <tbody> -->
      <?php
                $get = "select equipment as equipment_tnb, no_meter as meter ,alamat as address from  tnb2 where status = 'match'";
                $result = mysqli_query($link,$get);


                  ?>
                <?php

                  while($row = mysqli_fetch_array($result))
                  {
                    $data[]=$row;
                  

                ?>
               

            <?php } ?>        
                  </table>
                  <?php
                       
                mysqli_free_result($result);
                 // echo(json_encode($data));
                 
      }
      ?>
    <!-- </tbody> -->
    <!-- </table> -->
     
    <!-- </div> -->
</body>
</html>

 <script>
 var table = new Tabulator("#example-table-aa", {
    layout:"fitColumns",
    placeholder:"No Data Set",
    columns:[
        {title:"equipment_tnb", field:"equipment_tnb", sorter:"string"},
        {title:"meter", field:"meter", sorter:"string"},
        {title:"address", field:"address", sorter:"string"},
        // {title:"Rating", field:"rating", formatter:"star", align:"center", width:100},
        // {title:"Favourite Color", field:"col", sorter:"string"},
        // {title:"Date Of Birth", field:"dob", sorter:"date", align:"center"},
        // {title:"Driver", field:"car", align:"center", formatter:"tickCross", sorter:"boolean"},
    ],
});
    table.setData(<?php  echo(json_encode($data) );?>);
    $("#download-csv").click(function(){
    table.download("csv", "same.csv");
});

//trigger download of data.json file
$("#download-json").click(function(){
    table.download("json", "data.json");
});

//trigger download of data.xlsx file
$("#download-xlsx").click(function(){
    table.download("xlsx", "data.xlsx", {sheetName:"My Data"});
});

//trigger download of data.pdf file
$("#download-pdf").click(function(){
    table.download("pdf", "data.pdf", {
        orientation:"portrait", //set page orientation to portrait
        title:"Example Report", //add title to report
    });
});

//trigger download of data.html file
$("#download-html").click(function(){
    table.download("html", "data.html", {style:true});
});
 </script> 
