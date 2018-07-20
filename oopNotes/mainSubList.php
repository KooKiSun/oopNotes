<?php
//include_once "./layout/templetePage.inc"; // $MSubList 변수를 사용하기 위해 include함.
require_once "./Data/DBConnect.php"; // DB접속정보를 한번만 require 함

//$base = new Page; // MainPage class 객체를 생성

$DB = new DBFnc; // DBConfig class 객체를 생성

if (isset($_GET['MenuId'])) {
  //같은 ID일때는 동작 x -- Reload는 어떻게..?ㅠㅠ
  $MenuId = "";
  if ($MenuId !== $_GET['MenuId']) {
    $MenuId = htmlspecialchars($_GET['MenuId']);
    $SubMainMenuName = htmlspecialchars($_GET['MenuName']); //선택한 메뉴명을 다시 되돌려주기 위함.

    $DB->SqlInfo = "Select * From subMenus where MenuId = ".$MenuId;
    $Result = $DB->DBResult();

    //최종적으로 SubList 를 되돌려줄 변수.
    $SubList = "";
    while ($row = mysqli_fetch_array($Result)) {
      $SubId = htmlspecialchars($row['SubId']);
      $SubName = htmlspecialchars($row['SubName']);

      $SubList .= "<li><a id=\"SubId{$SubId}\" href=\"./postList.php?SubId={$SubId}&SubName={$SubName}\">{$SubName}</a></li>\n";
      };
    } else {
      $SubList .= "메뉴가 선택되지 않았네요..";
    };

    //여기서 지정한 변수들을 mainHome.php 에서 사용할 수 있도록 include 함.
    include("./mainHome.php");
  }
?>
