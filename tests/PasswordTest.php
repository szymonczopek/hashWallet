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


    public function testIsCorrectYes()
    {
        $data=[
            'login'=>'szymon',
            'password'=>'haslo',
            'webAddress'=>'adress',
            'description'=>'opis',
        ];

        $errors = $this->pass->isValidationCorrect($data);

        $this->assertEquals('',$errors);
    }
    public function testIsCorrectBadLoginAndWebAddress()
    {
        $data=[
            'login'=>'szymon',
            'password'=>false,
            'webAddress'=>null,
            'description'=>'szymon',
            ];

       $errors = $this->pass->isValidationCorrect($data);

      $this->assertEquals('password webAddress ',$errors);
    }

    public function testIsChangePasswordDataCorrectYes()
    {
        $user=5;
        $data=[
            'currentPass'=>'szymon',
            'newPass'=>'haslo',
            'newPass2'=>'haslo',
            'encrypt_choose'=>'sha',
        ];

        $errors = $this->pass->isChangePasswordDataCorrect($user,$data);

        $this->assertEquals('',$errors);
    }
    public function testIsChangePasswordDataCorrectPasswordDoNotMatch()
    {
        $user=5;
        $data=[
            'currentPass'=>'szymon',
            'newPass'=>'haslo',
            'newPass2'=>'haslo2',
            'encrypt_choose'=>'sha',
        ];

        $errors = $this->pass->isChangePasswordDataCorrect($user,$data);

        $this->assertEquals('Password does not match',$errors);
    }
    public function testIsChangePasswordDataCorrectInvalidCurrentPassword()
    {
        $user=-1;
        $data=[
            'currentPass'=>'szymon',
            'newPass'=>'haslo',
            'newPass2'=>'haslo',
            'encrypt_choose'=>'sha',
        ];

        $errors = $this->pass->isChangePasswordDataCorrect($user,$data);

        $this->assertEquals('Invalid current password',$errors);
    }







}