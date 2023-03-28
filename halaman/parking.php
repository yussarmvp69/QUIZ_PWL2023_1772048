<!--    Yussar Ma'arif Volindra Pratma 1772048  -->
<?php
session_start();
include_once 'utility/db_util.php';
include_once 'function/user.php';
if (!isset($_SESSION['registered_user'])) {
  $_SESSION['registered_user'] =  false;
}

$submitPressed = filter_input(INPUT_POST, 'btnSave');
if (isset($submitPressed)) {
  $VID = filter_input(INPUT_POST, 'txtVID');
  $Vtype = filter_input(INPUT_POST, 'txtType');
  $inCheck = filter_input(INPUT_POST, 'txtIn');
  $outCheck = filter_input(INPUT_POST, 'txtOut');
  $query = "INSERT INTO parking_detail(vehicle_id,vehicle_type,check_in_time,check_out_time) VALUES(?,?,?,?)";
  if (trim($Vtype) == ' ') {
    echo '<div> Please provide with valid name</div>';
  } else {
    $link = new PDO('mysql:host=localhost;dbname=pwl2022', 'root', 'jaeger12');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->beginTransaction();
    $query = 'INSERT INTO parking_detail(vehicle_id,vehicle_type,check_in_time,check_out_time) VALUES(?,?,?,?)';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $VID);
    $stmt->bindParam(2, $Vtype);
    $stmt->bindParam(1, $inCheck);
    $stmt->bindParam(2, $outCheck);
    if ($stmt->execute()) {
      $link->commit();
    } else {
      $link->rollBack();
    }
    $link = null;
  }
}
?>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <form action="" method="post">
      <label for="txtIsbn">Vehicle ID</label>
      <input type="text" maxlength="45" placeholder="Vtype" required autofocus name="txtType" id="txtType">
      <br>
      <label for="txtName">Vehicle Type</label>
      <input type="text" maxlength="45" placeholder="ParkPrice" required autofocus name="txtPrice" id="txtPrice">
      <br>
      <label for="txtName">Check in Time</label>
      <input type="date" id="txtIn" name="trip-start" value="2018-07-22" min="2018-01-01" max="2055-12-31">
      <br>
      <label for="txtName">Check out Time</label>
      <input type="date" id="txtOut" name="trip-start" value="2018-07-22" min="2018-01-01" max="2055-12-31">
      <input type="submit" value="Save Data" name="btnSave">
    </form>
  </div>

</nav>
<table class="table" id="myTable">
  <thead>
    <tr>
      <th>Check in-out</th>
      <th>Vehicle id-type</th>
      <th>Parking Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $link = createMySQLConnection();
    $query = 'SELECT * FROM parking_detail';

    $start_time = 'txtIn';
    $end_time = 'txtOut';
    $hourly_rate = 10;
    $start_timestamp = strtotime($start_time);
    $end_timestamp = strtotime($end_time);
    $total_time_seconds = $end_timestamp - $start_timestamp;
    $total_time_hours = $total_time_seconds / 3600;
    $total_cost = $total_time_hours * $hourly_rate;
    $result = $link->query($query);
    foreach ($result as $detail) {
      echo '<tr>';
      echo '<td>' . $detail['check_in_time'] . ['check_in_time'] . '</td>';
      echo '<td>' . $detail['vehicle_id'] . ['vehicle_type'] . '</td>';
      echo '<td>' . $total_cost . '</td>';
    }


    ?>
  </tbody>
</table>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  })
</script>