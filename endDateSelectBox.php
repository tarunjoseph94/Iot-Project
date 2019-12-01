<?php
  include ("includes/db-connect.php");
    include ("includes/header.php");
 ?>
<div class="input-field col s12">
  <select id="endDate">
    <option value="" disabled selected>Choose your option</option>
    <?php
      $key = $_POST['startpk'];
        $sql = "SELECT * FROM `log` WHERE `Sl_pK` > '.$key.' ORDER BY Sl_pK DESC ";
        $res2=mysqli_query($conn, $sql);
          while ($row = $res2->fetch_assoc()){
        ?>
    <option value="<?php echo $row['Sl_pK']; ?>"><?php echo $row['Date']; ?></option>
<?php } ?>
  </select>
  <label>End Date</label>
</div>
