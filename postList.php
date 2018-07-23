<?php
require_once "./Data/DBConnect.php";

$DB = new DBFnc; // DBConfig class 객체를 생성

if (isset($_GET['SubId'])) {


  include("./mainHome.php");
};

?>
