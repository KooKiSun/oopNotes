<?php

require_once "./Data/DBConnect.php";


if (isset($_GET['PostId'])) {
  $DB = new DBFnc; // DBConfig class 객체를 생성

  $PostId = htmlspecialchars($_GET['PostId']);
  $DB->SqlInfo = "Select * From posts where postId = ".$PostId;
  $Result = $DB->DBResult();
  $PostInfo = "";
  while ($row = mysqli_fetch_array($Result)) {
    // 우선 글 내용 전부를 받고 필요한 부분만 화면에 표기한다.
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

    $PostInfo .= "<div id=\"postInfo\">\n
                    <p><input style=\"whidt=100%\" type=\"text\" value=\"{$PostTitle}\" readonly></p>\n
                    <textarea id=\"postContents\" style=\"width:100%\">{$PostContents}</textarea>\n
                    <p><a href=\"./mainSubList.php?SubId={$PostSubId}\">되돌아가기</a></p>\n
                  </div>\n";
  }
  //해당 변수를 반환한다.
  echo $PostInfo;
}

?>
