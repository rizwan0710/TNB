<html>
<head>
<style type="text/css">
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
<center>
<h1> PCRM RESULT COMPARISON(UNMATCH)</h1><pre>
</center>
<div id="example-table-aa"></div>
<br><center>
<button id="button" type="submit" form="form1" value="Submit" id="download-csv">Convert - Excel</button></center>
<script>
var table = new Tabulator("#example-table-aa", {
    height:"1000px",
    layout:"fitColumns",
    paginationSize:100,
    placeholder:"No Data Set",
    columns:[
       {title:"equipment_tnb", field:"equipment_tnb", sorter:"string"},
        {title:"meter", field:"meter", sorter:"string"},
        {title:"address", field:"address", sorter:"string"},
    ],
});
table.setData("/tnb1/data.php");
  $("#download-csv").click(function(){
    table.download("csv", "unmatch.csv");
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
</html>