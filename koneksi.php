<?php
$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "db_kopimukidi";

// Create connection
$koneksi = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
