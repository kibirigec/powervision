<?php
require 'db.php';
$result = $conn->query("SELECT * FROM appliances");
while($row = $result->fetch_assoc()) {
    print_r($row);
}
?>
