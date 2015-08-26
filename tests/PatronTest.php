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

        // test that update method is working for name
        function test_updateName()
        {
            //Arrange
            $name = "Suzie Palloozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);
            $test_patron->save();

            $column_to_update = "name";
            $new_info = "Suzie P";

            //Act
            $test_patron->update($column_to_update, $new_info);

            //Assert
            $result = Patron::getAll();
            $this->assertEquals("Suzie P", $result[0]->getName());
        }

        // test that same update method is working for phone
        function test_updatePhone()
        {
            //Arrange
            $name = "Suzie Palloozi";
            $phone = "1-800-439-0398";
            $test_patron = new Patron($name, $phone);
            $test_patron->save();

            $column_to_update = "phone";
            $new_info = "570-943-0483";

            //Act
            $test_patron->update($column_to_update, $new_info);

            //Assert
            $result = Patron::getAll();
            $this->assertEquals("570-943-0483", $result[0]->getPhone());
        }

        function test_delete()
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
            $test_patron->delete();

            //Assert
            $result = Patron::getAll();
            $this->assertEquals($test_patron2, $result[0]);
        }
    }

 ?>
