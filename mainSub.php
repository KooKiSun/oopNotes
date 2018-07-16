<?php
require_once "./Data/DBConnect.php"; // DB접속정보를 한번만 require 함

$DB = new DBFnc; // DBConfig class 객체를 생성
//$DB->SqlInfo = "Select * From subMenus where MenuId = ?";
if (isset($_GET['MenuId'])) {
$DB->SqlInfo = "Select * From subMenus where MenuId = ".$_GET['MenuId'];
}

$Result = $DB->DBResult();

// while ($row = mysqli_fetch_array($Result)) {
//   $MenuId = htmlspecialchars($row['MenuId']);
//   $MenuName = htmlspecialchars($row['MenuName']);
//   $subId = htmlspecialchars($row['subId']);
//   $subName = htmlspecialchars($row['subName']);
//
//   $base->MHeaderList = $base->MHeaderList."<li><a href=\"{$row['subId']}\">{$row['subName']} | </a></li>\n";
//   };

//echo $base->Render(); //위의 변수들이 입력된 객체를 출력
?>
