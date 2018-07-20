<?php

include_once "./layout/templetePage.inc"; // 레이아웃을 한번만 include 함
require_once "./Data/DBConnect.php"; // DB접속정보를 한번만 require 함

$base = new Page; // MainPage class 객체를 생성

$base->link = "./css/mainStyle.css";

$DB = new DBFnc; // DBConfig class 객체를 생성
$DB->SqlInfo = "Select * From mainMenus";

$Result = $DB->DBResult();

while ($row = mysqli_fetch_array($Result)) {
  $MenuId = htmlspecialchars($row['MenuId']);
  $MenuName = htmlspecialchars($row['MenuName']);
  $base->MHeaderList .= "<li><a id=\"MenuId{$row['MenuId']}\" href=\"mainSubList.php?MenuId={$row['MenuId']}&MenuName={$row['MenuName']}\">{$row['MenuName']} | </a></li>\n";
  };

if (isset($SubList)) {
  $base->MMenuName .= $SubMainMenuName; // 선택한 메뉴 명.
  $base->MSubList .= $SubList;
} else {
  $base->JScript .= "window.onload = function(){MenuId1.click();}\n";
}

// if (isset($TTitle)) {
//   $base->contents .= $TTitle;//게시판 타이틀
// }
echo $base->Render(); //위의 변수들이 입력된 객체를 출력
?>
