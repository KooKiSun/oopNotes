<?php

include_once "./layout/templetePage.inc"; // 레이아웃을 한번만 include 함
require_once "./Data/DBConnect.php"; // DB접속정보를 한번만 require 함

$base = new Page; // MainPage class 객체를 생성

$base->link = "./css/mainStyle.css";
echo $base->Render(); //위의 변수들이 입력된 객체를 출력

$DB = new DBConfig; // DBConfig class 객체를 생성
$DB->$SqlInfo = "Select * From KooNotes";
$DB->DBResult();
?>
