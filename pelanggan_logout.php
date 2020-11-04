<?php

include 'koneksi.php';

session_start();

unset($_SESSION['id_pelanggan']);
unset($_SESSION['status']);

header("location:index.php");
