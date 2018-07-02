<?php
// templeteMethod를 이용한 객체지향 방식의 WebApplication. 2018.07.02 시작.
/**
 * 기본 템플릿을 정의 할 수 있는 Class를 생성.
 */
abstract class MainPage
{
  //템플릿을 출력
  protected final function templete()
  {
    $result = $this->MainLoad(); //메인 페이지를 취합하여 로드.

    return $result;
  }

  //템플릿을 상속받아 자녀 클레스에서 실제 내용을 작성할 수 있도록 추상화 클레스를 사용.
  protected abstract function MainLoad();      //메인 페이지를 취합하여 로드
  protected abstract function MainHeader();    //헤더 영역
  protected abstract function MainSection();   //본문 영역 <section><aside><article>로 구성
  protected abstract function MainLeftAside(); //본문 영역 <section><aside><article>로 구성
  protected abstract function MainContents();  //본문 영역 <section><aside><article>로 구성
  protected abstract function MainFooter();    //하단 푸터 영역

  public function Render()
  {
    return $this->templete();
  }
}

/**
 * 추상화 클레스를 상속 받아 메인 페이지를 작성.
 */
class page extends MainPage
{
  public $title = "밤비의 일상-BBHouse";
  public $contents = "본문이 표기될 영역";
  public $link; // 스타일 적용 변수.

  //헤더 영역
  protected function MainLoad()
  {
    $result =  "<!DOCTYPE html>\n<html lang='ko'>\n";
    $result .= "  <head>\n<meta charset='utf-8'/>\n";
    $result .= "    <title>".$this->title."</title>\n";
    $result .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->link."\"/>\n";
    $result .= "  </head>\n<body>\n <div id=\"container\">\n";
    $result .= $this->MainHeader();  // 헤더영역
    $result .= $this->MainSection(); // 본문 영역
    $result .= $this->MainFooter();  // 하단 푸터 영역
		$result .= "</div>\n</body>\n</html>";
    return $result;
  }

  protected function MainHeader()
  {
    $result =  "<header>\n";
    $result .= "<div id=\"mainTop\">\n";
    $result .= "    <div id=\"mainLogo\">\n";
    $result .= "      <h1><a href=\"./mainHome.php\">Home</a></h1>\n";
    $result .= "    </div>\n";

    $result .= "    <div id=\"mainInfo\">\n";
    $result .= "      <input type=\"button\" name=\"btnlogin\" value=\"로그인\">\n";
    $result .= "      <input type=\"button\" name=\"btnsettings\" value=\"설정\" onclick=\"location.href='./settings/settings.php'\">\n";
    $result .= "    </div>\n";
    $result .= "  </div>\n";

    $result .= "  <div id=\"mainMenus\">\n";
    $result .= "    <ul>\n";
    $result .= "      <li><a href=\"#\">메인메뉴1 | </a></li>\n";
    $result .= "      <li><a href=\"#\">메인메뉴2 | </a></li>\n";
    $result .= "      <li><a href=\"#\">메인메뉴3 | </a></li>\n";
    $result .= "      <li><a href=\"#\">메인메뉴4 | </a></li>\n";
    $result .= "    </ul>\n";
    $result .= "  </div>\n";
    $result .= "</header>\n";
    return $result;
  }

  protected function MainSection()
  {
    $result = "<section>\n";
    $result .= $this->MainLeftAside();
    $result .= $this->MainContents();
    $result .= "</section>\n";
    return $result;
  }

  protected function MainLeftAside()
  {
    $result =  "  <aside id=\"subMenuList\">\n";
    $result .= "    <h3><a href=\"#\">메인메뉴1</a></h3>\n";
    $result .= "    <ul>\n";
    $result .= "     </br>\n";
    $result .= "     <li>서브메뉴1</li>\n";
    $result .= "     <li>서브메뉴2</li>\n";
    $result .= "     <li>서브메뉴3</li>\n";
    $result .= "    </ul>\n";
    $result .= "  </aside>\n";
    return $result;
  }

  protected function MainContents()
  {
    $result = "  <article>".$this->contents."</article>\n";
    return $result;
  }

  protected function MainFooter()
  {
    $result = "<footer>Copyright &copy; BBCompany - 무단 배포 금지.</footer>\n";
    return $result;
  }
}
 ?>
