<!--    Yussar Ma'arif Volindra Pratma 1772048  -->
<?php
function createMySQLConnection()
{
  $link = new PDO('mysql:host=localhost;dbname=pwl2022', 'root', 'jaeger12');
  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
  return $link;
}
function closeConnection(PDO $link)
{
  if ($link != null) {
    $link = null;
  }
}
