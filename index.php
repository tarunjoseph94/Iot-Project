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
<div class="container">
  <div class="row">
    <div class="col s12 m12">
      <?php
          $sql = "SELECT * FROM `log` ORDER BY `Sl_pK` DESC LIMIT 1";
          $res2=mysqli_query($conn, $sql);
            while ($row = $res2->fetch_assoc()){
          ?>
          <div class="">
            <center>
              <h4>Latest reading</h4>
            </center>
            <div class="row">
              <div class="col l3 s6">
                <h5>
                  Humidity:<span class="humidPrevious"> <?php echo $row['humid'].'%'; ?></span>
                </h5>
              </div>
              <div class="col l3 s6">
                <h5>
                  Temperature:<span class="tempPrevious"><?php echo $row['temp']." C"; ?></span>
                </h5>
              </div>
              <div class="col l3 s6">
                <h5>
                  Moisture: <span class="moistPrevious"><?php echo $row['moist']."%"; ?></span>
                </h5>
              </div>
              <div class="col l3 s6">
                <h5>
                  Light:<span class="lightPrevious"><?php echo $row['light']."%"; ?></span>
                </h5>
              </div>

            </div>
          </div>
          <?php }
       ?>
    </div>
    <div class="">

    </div>
    <center>
        <h3>Previous Trends</h3>
    </center>

    <div class="col s12 l6">
        <div id="charthumidContainer" class="chart"></div>
    </div>
    <div class="col s12 l6">
        <div id="charttempContainer" class="chart"></div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 l6">
        <div id="chartMoistureContainer" class="chart"></div>
    </div>
    <div class="col s12 l6">
        <div id="chartLightContainer" class="chart"></div>
    </div>
  </div>
</div>

</body>
</html>
