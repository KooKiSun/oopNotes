<?php
//include_once "./layout/templetePage.inc"; // $MSubList 변수를 사용하기 위해 include함.
require_once "./Data/DBConnect.php"; // DB접속정보를 한번만 require 함

//$base = new Page; // MainPage class 객체를 생성

$DB = new DBFnc; // DBConfig class 객체를 생성

if (isset($_GET['SubId'])) {
$PostSubId = htmlspecialchars($_GET['SubId']);
//해당 서브 메뉴에 등록된 글을 전부 불러오기. -> 나중엔 페이징 처리해야함..
$DB->SqlInfo = "Select * From posts where PostSubId = ".$PostSubId;
$Result = $DB->DBResult();

//게시판의 타이틀을 만든다.
$TTitle = "";
$TTitle .= "<div class=\"table_group\">\n";
$TTitle .= "    <table class=\"table\">\n";
$TTitle .= "      <caption>\n";
$TTitle .= "      <strong>테이블 제목</strong>\n";
$TTitle .= "      </caption>\n";
$TTitle .= "      <colgroup>\n";
$TTitle .= "      <col style=\"width: 5%;\">\n";
//$TTitle .= "      <col style=\"width: 50%;\">\n";
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
  $PostId = htmlspecialchars($row['PostId']);
  $PostUserId = htmlspecialchars($row['PostUserId']);
  $PostTitle = htmlspecialchars($row['PostTitle']);
  $PostCDate = htmlspecialchars($row['PostCDate']);
  $PostPrivate = htmlspecialchars($row['PostPrivate']);

  $TTitle .= "        <tr>\n";
  // $TTitle .= "          <td><a href=\"./postInfo.php?PostId=".htmlspecialchars($row['PostId'])."\"</a>".htmlspecialchars($row['PostId'])."</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostTitle'])."</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostUserId'])."</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostPrivate'])."</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostCDate'])."</td>\n";
  $TTitle .= "          <td><a href=\"./postInfo.php?PostId={$PostId}\"</a>{$PostId}</td>\n";
  $TTitle .= "          <td><a href=\"./postInfo.php?PostId={$PostId}\"</a>{$PostTitle}</td>\n";
  $TTitle .= "          <td><a href=\"./postInfo.php?PostId={$PostId}\"</a>{$PostUserId}</td>\n";
  $TTitle .= "          <td><a href=\"./postInfo.php?PostId={$PostId}\"</a>{$PostPrivate}</td>\n";
  $TTitle .= "          <td><a href=\"./postInfo.php?PostId={$PostId}\"</a>{$PostCDate}</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostTitle'])."</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostUserId'])."</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostPrivate'])."</td>\n";
  // $TTitle .= "          <td>".htmlspecialchars($row['PostCDate'])."</td>\n";
  $TTitle .= "        </tr>\n";
  };
} else {
  $SubList .= "메뉴가 선택되지 않았네요..";
};

$TTitle .= "      </tbody>\n";
$TTitle .= "    </table>\n";
$TTitle .= "  </div>\n";
  //여기서 지정한 변수들을 mainHome.php 에서 사용할 수 있도록 include 함.
  include("./mainHome.php");
?>
