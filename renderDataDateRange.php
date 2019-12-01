<?php
include ('includes/header.php');
include ('includes/db-connect.php');
$startpk=$_POST['startpk'];
$endpk=$_POST['endpk'];
$sql= "SELECT * FROM ( SELECT * FROM `log` order by `Sl_pK` desc ) tmp WHERE `Sl_pK` >= '$startpk' AND `Sl_pK` <= '$endpk' order by tmp.`Sl_pK` ASC";
$humidData=array();
$tempData=array();
$moistData=array();
$lightData=array();
$test=1;
//print_r($sql);
$res2=mysqli_query($conn, $sql);
  while ($row = $res2->fetch_assoc()){

    array_push($humidData,
                  array(
                      "y" => $row["humid"],
                      "label" => $row["Date"].' '.substr($row['Time'],0,5)

                  )
              );
              array_push($tempData,
                            array(
                                "y" => $row["temp"],
                                "label" => $row["Date"].' '.substr($row['Time'],0,5)

                            )
                        );
                        array_push($moistData,
                                      array(
                                          "y" => $row["moist"],
                                          "label" => $row["Date"].' '.substr($row['Time'],0,5)

                                      )
                                  );
                                  array_push($lightData,
                                                array(
                                                    "y" => $row["light"],
                                                    "label" => $row["Date"].' '.substr($row['Time'],0,5)

                                                )
                                            );
  }
  //echo '<br/> ';
  //print_r($humidData);
  //echo '<br/> ';
   //print_r($test);
  ?>
  <script>
let humid = <?php echo json_encode($humidData, JSON_NUMERIC_CHECK); ?>;
let temp = <?php echo json_encode($tempData, JSON_NUMERIC_CHECK); ?>;
let moist = <?php echo json_encode($moistData, JSON_NUMERIC_CHECK); ?>;
let light = <?php echo json_encode($lightData, JSON_NUMERIC_CHECK); ?>;
var chartHumid = new CanvasJS.Chart("charthumidContainer", {
title: {
  text: "All Data"
},
axisY: {
  title: ""
},
data: [{
  type: "line",
  name:"Humidity",
  showInLegend: true,
  legendText: "Humdity % ",
  dataPoints:humid
},
{
  type: "line",
  name:"Temperature",
  showInLegend: true,
  legendText: "Temperature in celsius ",
  dataPoints:temp
},
{
  type: "line",
  name:"Moisture",
  showInLegend: true,
  legendText: "Moisture %",
  dataPoints:moist
},	{
    type: "line",
    name:"Light",
    showInLegend: true,
    legendText: "Light % ",
    dataPoints:light
  }]
});
chartHumid.render();


</script>

<div id="charthumidContainer" class="chart"></div>
