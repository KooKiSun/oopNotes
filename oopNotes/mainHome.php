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
  $base->MHeaderList .= "<li><a id=\"MenuId{$MenuId}\" href=\"./mainSubList.php?MenuId={$MenuId}\">{$MenuName} | </a></li>\n";
  };

  //왼쪽 서브 메뉴 리스트
  if (isset($SubList)) {
    // 선택한 메뉴 명.
    $base->MMenuName .= $MainMenuName;
    $base->MSubList .= $SubList;
  } else {
    $base->JScript .= "window.onload = function(){MenuId1.click();}\n";
  };

  //본문 영역
  if (isset($TTitle)) {
    $base->contents .= $TTitle."\n";
  };

  if (include("./postInfo.php")){
    $PostInfo = include "./postInfo.php";
    $base->contents .= $PostInfo."\n";
  }

echo $base->Render(); //위의 변수들이 입력된 객체를 출력

?>
