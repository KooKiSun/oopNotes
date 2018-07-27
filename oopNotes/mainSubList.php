<?php
require_once "./Data/DBConnect.php"; // DB접속정보를 한번만 require 함
$DB = new DBFnc; // DBConfig class 객체를 생성
if (isset($_GET['MenuId'])) {
  $MenuId = "";
  if ($MenuId !== $_GET['MenuId']) {
    $MenuId = htmlspecialchars($_GET['MenuId']);

    $DB->SqlInfo = "Select * From mainMenus where MenuId = ".$MenuId;
    $Result = $DB->DBResult();

    //메인 메뉴명 가져오기.
    while ($row = mysqli_fetch_array($Result)) {
      $MainMenuName = htmlspecialchars($row['MenuName']);
    };

    //서브메뉴 가져오기.
    $DB->SqlInfo = "Select * From subMenus where MenuId = ".$MenuId;
    $Result = $DB->DBResult();
    //최종적으로 SubList 를 되돌려줄 변수.
    $SubList = "";
    while ($row = mysqli_fetch_array($Result)) {
      $SubId = htmlspecialchars($row['SubId']);
      $SubName = htmlspecialchars($row['SubName']);

      $SubList .= "<li><a id=\"SubId{$SubId}\" href=\"./mainSubList.php?MenuId={$MenuId}&SubId={$SubId}\">{$SubName}</a></li>\n";
    };
  } else {
    $SubList .= "서브 메뉴가 선택되지 않았네요..";
  };
};

//해당 서브 메뉴에 등록된 글을 전부 불러오기. -> 나중엔 페이징 처리해야함..
if (isset($_GET['SubId'])) {
  $SubId = htmlspecialchars($_GET['SubId']);
  $DB->SqlInfo = "Select * From subMenus where SubId = ".$SubId;
  $Result = $DB->DBResult();
  //서브 메뉴명 가져오기.
  while ($row = mysqli_fetch_array($Result)) {
    $MainSubName = htmlspecialchars($row['SubName']);
  }

  $DB->SqlInfo = "Select * From posts where PostSubId = ".htmlspecialchars($_GET['SubId']);
  $Result = $DB->DBResult();

  //게시판의 타이틀을 만든다.
  $TTitle = "";
  $TTitle .= "<div class=\"table_group\">\n";
  $TTitle .= "    <table class=\"table\">\n";
  $TTitle .= "      <caption>\n";
  $TTitle .= "      <strong>{$MainSubName}</strong>\n";
  $TTitle .= "      </caption>\n";
  $TTitle .= "      <colgroup>\n";
  $TTitle .= "      <col style=\"width: 5%;\">\n";
  $TTitle .= "      <col style=\"width: 20%;\">\n";
  $TTitle .= "      <col style=\"width: 5%;\">\n";
  $TTitle .= "      <col style=\"width: 5%;\">\n";
  $TTitle .= "      <col style=\"width: 5%;\">\n";
  $TTitle .= "      </colgroup>\n";
  $TTitle .= "        <tr>\n";
  $TTitle .= "      <thead>\n";
  $TTitle .= "          <th scope=\"col\">게시번호</th>\n";
  $TTitle .= "          <th scope=\"col\">제목</th>\n";
  $TTitle .= "          <th scope=\"col\">작성자</th>\n";
  $TTitle .= "          <th scope=\"col\">공개여부</th>\n";
  $TTitle .= "          <th scope=\"col\">작성일자</th>\n";
  $TTitle .= "        </tr>\n";
  $TTitle .= "      </thead>\n";
  $TTitle .= "      <tbody>\n";
  /*
  $PostId = htmlspecialchars($row['PostId']);
  $PostSubId = htmlspecialchars($row['PostSubId']);
  $PostUserId = htmlspecialchars($row['PostUserId']);
  $PostTitle = htmlspecialchars($row['PostTitle']);
  $PostContents = htmlspecialchars($row['PostContents']);
  $PostFileIds = htmlspecialchars($row['PostFileIds']);
  $PostCDate = htmlspecialchars($row['PostCDate']);
  $PostMdate = htmlspecialchars($row['PostMdate']);
  $PostPrivate = htmlspecialchars($row['PostPrivate']);
  $PostPw = htmlspecialchars($row['PostPw']);
  */
  while ($row = mysqli_fetch_array($Result)) {
    //htmlspecialchars($row['PostId']); 문장이 너무 길어서 변수로 치환하여 사용한다..
    $PostId = htmlspecialchars($row['PostId']);
    $PostUserId = htmlspecialchars($row['PostUserId']);
    $PostTitle = htmlspecialchars($row['PostTitle']);
    $PostCDate = htmlspecialchars($row['PostCDate']);
    $PostPrivate = htmlspecialchars($row['PostPrivate']);
    $TTitle .= "        <tr>\n";
    $TTitle .= "          <td><a href=\"./postInfo.php?SubId={$SubId}&PostId={$PostId}\"</a>{$PostId}</td>\n";
    $TTitle .= "          <td><a href=\"./postInfo.php?SubId={$SubId}&PostId={$PostId}\"</a>{$PostTitle}</td>\n";
    $TTitle .= "          <td><a href=\"./postInfo.php?SubId={$SubId}&PostId={$PostId}\"</a>{$PostUserId}</td>\n";
    $TTitle .= "          <td><a href=\"./postInfo.php?SubId={$SubId}&PostId={$PostId}\"</a>{$PostPrivate}</td>\n";
    $TTitle .= "          <td><a href=\"./postInfo.php?SubId={$SubId}&PostId={$PostId}\"</a>{$PostCDate}</td>\n";
    $TTitle .= "        </tr>\n";
    };
    $TTitle .= "      </tbody>\n";
    $TTitle .= "    </table>\n";
    $TTitle .= "  </div>\n";
  };
  //여기서 지정한 변수들을 mainHome.php 에서 사용할 수 있도록 include 함.
  include("./mainHome.php");

?>
