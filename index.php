<html>
<head>
<?php include ('includes/header.php'); ?>
</head>
<body>
  <nav>
    <?php include ('includes/nav_bar.php'); ?>
</nav>
  <?php
  include ('includes/db-connect.php');

  //$sql = "SELECT * FROM `log` ORDER BY `Sl_pK` DESC LIMIT 20";
  $sql= "SELECT * FROM (
    SELECT * FROM `log` order by `Sl_pK` desc limit 20
) tmp order by tmp.`Sl_pK` asc";
  $humidData=array();
  $tempData=array();
  $moistData=array();
  $lightData=array();
  $res2=mysqli_query($conn, $sql);
    while ($row = $res2->fetch_assoc()){
      array_push($humidData,
                    array(
                        "y" => $row["humid"],
                        "label" => $row["Date"].' '.$row['Time']

                    )
                );
                array_push($tempData,
                              array(
                                  "y" => $row["temp"],
                                  "label" => $row["Date"].' '.$row['Time']

                              )
                          );
                          array_push($moistData,
                                        array(
                                            "y" => $row["moist"],
                                            "label" => $row["Date"].' '.$row['Time']

                                        )
                                    );
                                    array_push($lightData,
                                                  array(
                                                      "y" => $row["light"],
                                                      "label" => $row["Date"].' '.$row['Time']

                                                  )
                                              );
    }
    //echo '<br/> ';
    //print_r($humidData);
    //echo '<br/> ';
    ?>
    <script>
window.onload = function () {

var chartHumid = new CanvasJS.Chart("charthumidContainer", {
	title: {
		text: "Humidity"
	},
	axisY: {
		title: "humidity"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($humidData, JSON_NUMERIC_CHECK); ?>
	}]
});
var chartTemp = new CanvasJS.Chart("charttempContainer", {
	title: {
		text: "Temperature"
	},
	axisY: {
		title: "Temperature"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($tempData, JSON_NUMERIC_CHECK); ?>
	}]
});
var chartMoisture = new CanvasJS.Chart("chartMoistureContainer", {
	title: {
		text: "Moisture"
	},
	axisY: {
		title: "Moisture"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($moistData, JSON_NUMERIC_CHECK); ?>
	}]
});
var chartLight = new CanvasJS.Chart("chartLightContainer", {
	title: {
		text: "Light"
	},
	axisY: {
		title: "Light"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($lightData, JSON_NUMERIC_CHECK); ?>
	}]
});
chartHumid.render();
chartTemp.render();
chartLight.render();
chartMoisture.render();

}
</script>
<div class="container-fluid">
  <div class="row">
    <div class="col s12">
      <?php
          $sql = "SELECT * FROM `log` ORDER BY `Sl_pK` DESC LIMIT 1";
          $res2=mysqli_query($conn, $sql);
            while ($row = $res2->fetch_assoc()){
          ?>
          <div class="">
            <center>
              <h4>Lastest reading</h4>
            </center>
            <div class="row">
              <div class="col s3">
                <h5>
                  Humidity: <?php echo $row['humid'].'%'; ?>
                </h5>
              </div>
              <div class="col s3">
                <h5>
                  Temperature: <?php echo $row['temp']." C"; ?>
                </h5>
              </div>
              <div class="col s3">
                <h5>
                  Moisture: <?php echo $row['moist']."%"; ?>
                </h5>
              </div>
              <div class="col s3">
                <h5>
                  Light: <?php echo $row['light']."%"; ?>
                </h5>
              </div>

            </div>


          </div>
          <?php }
       ?>
    </div>
    <hr />
    <center>
        <h3>Previous Trends</h3>
    </center>

    <div class="col s6">
        <div id="charthumidContainer" class="chart"></div>
    </div>
    <div class="col s6">
        <div id="charttempContainer" class="chart"></div>
    </div>
  </div>
  <div class="row">
    <div class="col s6">
        <div id="chartMoistureContainer" class="chart"></div>
    </div>
    <div class="col s6">
        <div id="chartLightContainer" class="chart"></div>
    </div>
  </div>
</div>

</body>
</html>
