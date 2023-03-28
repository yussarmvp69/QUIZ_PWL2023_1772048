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
  $Vtype = filter_input(INPUT_POST, 'txtType');
  $ParkPrice = filter_input(INPUT_POST, 'txtPrice');
  $query = "INSERT INTO ticket_price(type,price) VALUES(?,?)";
  if (trim($Vtype) == ' ') {
    echo '<div> Please provide with valid name</div>';
  } else {
    $link = new PDO('mysql:host=localhost;dbname=pwl2022', 'root', 'jaeger12');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->beginTransaction();
    $query = 'INSERT INTO ticket_price(type,price) VALUES(?,?)';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $Vtype);
    $stmt->bindParam(2, $ParkPrice);
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
      <label for="txtIsbn">Vehicle Type</label>
      <input type="text" maxlength="45" placeholder="Vtype" required autofocus name="txtType" id="txtType">
      <br>
      <label for="txtName">Parking Price</label>
      <input type="text" maxlength="45" placeholder="ParkPrice" required autofocus name="txtPrice" id="txtPrice">


      <input type="submit" value="Save Data" name="btnSave">
    </form>
  </div>

</nav>
<table class="table" id="myTable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Vehicle Type</th>
      <th>Parking Price</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $link = createMySQLConnection();
    $query = 'SELECT * FROM ticket_price';
    $result = $link->query($query);
    foreach ($result as $ticket) {
      echo '<tr>';
      echo '<td>' . $ticket['id'] . '</td>';
      echo '<td>' . $ticket['type'] . '</td>';
      echo '<td>' . $ticket['price'] . '</td>';
      echo '<td>' . $ticket['active'] . '</td>';
    }

    ?>
  </tbody>
</table>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  })
</script>