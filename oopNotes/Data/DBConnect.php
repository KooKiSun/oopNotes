<?php
/**
 * 기본적인 DBConnect를 이 클레스에 적용하고 수정 할 수 없도록 추상화 클레스를 사용한다.
 * 2018.07.08
 */
class DBConfig
{
  //mysqli 기능을 이용한 DataBase 접속 및 Data처리를 진행한다.
  //DBConnect를 상속받아 자녀 클레스에서 실제 내용을 작성할 수 있도록 추상화 클레스를 사용.
  protected abstract function DBCon(); //DataBase 연결
  protected abstract function DBSql(); //sql 받아 결과 값을 Return 해준다.

  //템플릿을 출력
  protected final function DBResult()
  {
    $result = $this->DBCon();
    $result = $this->DBSql();

    return $result;
  }

}

/**
 * DBConfig 를 상속받아 실제 필요한 내용들을 작성.
 */
class DBFnc extends DBConfig
{
  private $conn;//DB 접속 정보는 변경되어서는안되기 때문에 Private 변수를 사용
  protected $SqlInfo; //필요한 질의를 받는 변수. 가변적으로 사용해야하기 때문에 protected를 사용.
  protected function DBCon() //DataBase 연결
  {
    $conn = mysqli_connect('127.0.0.1', 'root', '000000', 'Koos');
  }

  protected function DBSql() //sql 받아 결과 값을 Return 해준다.
  {
    return mysqli_query($conn,mysqli_real_escape_string($SqlInfo));
  }
}



 ?>
