<?php
declare(strict_types=1);

include 'controllers/classes/Password.php';

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    private $pass;

    public function setUp() : void
    {
        parent::setUp();

        $this->pass = new Password();
    }


    public function testIsValidationCorrect_Yes()
    {
        $data=[
            'login'=>'szymon',
            'password'=>'haslo',
            'webAddress'=>'adress',
            'description'=>'opis',
        ];

        $errors = $this->pass->isValidationCorrect($data);

        self::assertEquals('',$errors);
    }
    public function testIsValidationCorrect_BadLoginAndWebAddress()
    {
        $data=[
            'login'=>'szymon',
            'password'=>false,
            'webAddress'=>null,
            'description'=>'szymon',
            ];

       $errors = $this->pass->isValidationCorrect($data);

        self::assertEquals('password webAddress ',$errors);
    }

    public function testIsChangePasswordDataCorrect_Yes()
    {
        $user=5;
        $data=[
            'currentPass'=>'szymon',
            'newPass'=>'haslo',
            'newPass2'=>'haslo',
            'encrypt_choose'=>'sha',
        ];

        $errors = $this->pass->isChangePasswordDataCorrect($user,$data);

        self::assertEquals('',$errors);
    }
    public function testIsChangePasswordDataCorrect_PasswordDoNotMatch()
    {
        $user=5;
        $data=[
            'currentPass'=>'szymon',
            'newPass'=>'haslo',
            'newPass2'=>'haslo2',
            'encrypt_choose'=>'sha',
        ];

        $errors = $this->pass->isChangePasswordDataCorrect($user,$data);

        self::assertEquals('Password does not match',$errors);
    }

    public function testIsChangePasswordDataCorrect_InvalidCurrentPassword()
    {
        $user=-1;
        $data=[
            'currentPass'=>'zlehaslo',
            'newPass'=>'haslo',
            'newPass2'=>'haslo',
            'encrypt_choose'=>'sha',
        ];

        $errors = $this->pass->isChangePasswordDataCorrect($user,$data);

        self::assertEquals('Invalid current password',$errors);
    }
    public function testIsStringShowLogin(){
        $login='szymon';

        $showLogin=$this->pass->showLogin($login);
        self::assertIsString($showLogin);
    }
    public function testCorrectShowLogin(){
        $login='szymon';

        $showLogin=$this->pass->showLogin($login);
        self::assertEquals("User name: " . $login . "<br/>",$showLogin);
    }






}