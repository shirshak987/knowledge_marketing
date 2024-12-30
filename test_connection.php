<?php
include "dbconnection.php";

if ($conn) {
    echo "Connected to the database successfully!";
} else {
    echo "Failed to connect to the database.";
}
?>
