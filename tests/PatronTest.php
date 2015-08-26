<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patron.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatronTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Patron::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Suzie Pallozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);

            //Act
            $result = $test_patron->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {

        }
    }

 ?>
