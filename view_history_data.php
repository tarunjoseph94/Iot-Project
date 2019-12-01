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
  ?>
<div class="container">
  <div class="row">
    <div class="col s12">
          <div class="">
            <center>
              <h4>Date Range</h4>
            </center>
            <div class="row">
              <div class="col s6 offset s2">
                <div class="input-field col s12">
                  <select id="startDate">
                    <option value="" disabled selected>Choose your option</option>
                    <?php
                        $sql = "SELECT * FROM `log` ORDER BY `Sl_pK` DESC ";
                        $res2=mysqli_query($conn, $sql);
                          while ($row = $res2->fetch_assoc()){
                        ?>
                    <option value="<?php echo $row['Sl_pK']; ?>"><?php echo $row['Date']; ?></option>
                <?php } ?>
                  </select>
                  <label>Start Date</label>
                </div>
              </div>
              <div class="col s6">
                <div id="endDateResults">

                </div>
              </div>


            </div>


          </div>

    </div>

    <center>
        <h3>Previous Trends</h3>
    </center>

    <div class="col s12">
      <div id="graphResult">

      </div>

    </div>
  </div>
</div>

</body>
</html>
