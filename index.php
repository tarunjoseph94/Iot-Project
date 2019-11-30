<html>
<head>

</head>
<body>
  <?php
  include 'db-connect.php';
  $sql = "SELECT * FROM `log`";
  $res2=mysqli_query($conn, $sql2);
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
          echo $row['Sl_pk'];
          ?>
        </td>
        <td>
          <?php
          echo $row['humid'];
          ?>
        </td>
        <td>
          <?php
          echo $row['temp'];
          ?>
        </td>
        <td>
          <?php
          echo $row['moist'];
          ?>
        </td>
        <td>
          <?php
          echo $row['light'];
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
      $batch=$row['batch'];
    }
  </table>
  ?>

</body>
</html>
