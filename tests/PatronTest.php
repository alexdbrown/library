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
            $name = "Suzie Palloozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);

            //Act
            $result = $test_patron->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Suzie Palloozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);

            //Act
            $test_patron->save();

            //Assert
            $result = Patron::getAll();
            $this->assertEquals($test_patron, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Suzie Palloozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);
            $test_patron->save();

            $name2 = "Tac Zoltani";
            $phone2 = "1-800-407-3930";
            $test_patron2 = new Patron($name2, $phone2);
            $test_patron2->save();

            //Act
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron, $test_patron2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Suzie Palloozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);
            $test_patron->save();

            $name2 = "Tac Zoltani";
            $phone2 = "1-800-407-3930";
            $test_patron2 = new Patron($name2, $phone2);
            $test_patron2->save();

            //Act
            Patron::deleteAll();

            //Assert
            $result = Patron::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Suzie Palloozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);
            $test_patron->save();

            $name2 = "Tac Zoltani";
            $phone2 = "1-800-407-3930";
            $test_patron2 = new Patron($name2, $phone2);
            $test_patron2->save();

            //Act
            $result = Patron::find($test_patron2->getId());

            //Assert
            $this->assertEquals($test_patron2, $result);
        }
    }

 ?>
