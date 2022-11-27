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






}