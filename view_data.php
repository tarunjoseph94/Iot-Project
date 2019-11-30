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
  $sql = "SELECT * FROM `log`";
  $res2=mysqli_query($conn, $sql);
  ?>
  <table>
    <tr>
      <th>
        Sl no
      </th>
      <th>
        Humidity
      </th>
      <th>
        Temp
      </th>
      <th>
        Moist
      </th>
      <th>
        Light
      </th>
      <th>
        Date
      </th>
      <th>
        Time
      </th>
    </tr>

    <?php
    while ($row = $res2->fetch_assoc()){
      ?>
      <tr>
        <td>
          <?php
          echo $row['Sl_pK'];
          ?>
        </td>
        <td>
          <?php
          echo $row['humid']."%";
          ?>
        </td>
        <td>
          <?php
          echo $row['temp']."C";
          ?>
        </td>
        <td>
          <?php
          echo $row['moist']."%";
          ?>
        </td>
        <td>
          <?php
          echo $row['light']."%";
          ?>
        </td>
        <td>
          <?php
          echo $row['Date'];
          ?>
        </td>
        <td>
          <?php
          echo $row['Time'];
          ?>
        </td>
      </tr>
    <?php } ?>
  </table>


</body>
</html>
