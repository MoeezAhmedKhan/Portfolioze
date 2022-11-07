<?php

$Host = 'localhost';
$DB_DATABASE='sassolut_gupta';
$DB_USERNAME='sassolut_gupta';
$DB_PASSWORD='sassolut_gupta';

$conn = mysqli_connect($Host, $DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}