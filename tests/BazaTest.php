<?php
declare(strict_types=1);

include 'controllers/classes/Baza.php';

use PHPUnit\Framework\TestCase;

class BazaTest extends TestCase
{
    private $db;

    public function setUp() : void
    {
        parent::setUp();

        $this->db = new Baza("localhost","root","","bsiBase");
    }

   /* public function testSelectUser_Correct()
    {
        $login= 'www';
        $passwd='eeee';
        $tabela='users';

        $result=$this->db->selectUser($login,$passwd,$tabela);
        self::assertEquals('136',$result);
    }*/

    public function testSelectUser_Incorrect()
    {
        $login= 'www';
        $passwd='eeeeccccc';
        $tabela='users';

        $result=$this->db->selectUser($login,$passwd,$tabela);
        self::assertEquals(NULL,$result);
    }
  /*  public function testSelectPole_Login()
    {
        $sql="select login from users where id_user=136";
        $pola=array("login");
        $result=$this->db->selectPole($sql,$pola);
        self::assertEquals(' www ',$result);
    }*/

  /*  public function testSelectPole_Email()
    {
        $sql="select email from users where id_user=136";
        $pola=array("email");
        $result=$this->db->selectPole($sql,$pola);
        self::assertEquals(' www@wp.pl ',$result);
    }*/








}