<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Author.php";
    // require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            // Book::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Ashlin Aronin";
            $test_author = new Author($name);

            //Act
            $result = $test_author->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Ashlin Aronin";
            $test_author = new Author($name);

            //Act
            $test_author->save();

            //Assert
            $result = Author::getAll();
            $this->assertEquals($test_author, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Ashlin Aronin";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Vincent Adultman";
            $test_author2 = new Author($name2);
            $test_author2->save();

            //Act
            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author, $test_author2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Ashlin Aronin";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Vincent Adultman";
            $test_author2 = new Author($name2);
            $test_author2->save();

            //Act
            Author::deleteAll();

            //Assert
            $result = Author::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Ashlin Aronin";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Vincent Adultman";
            $test_author2 = new Author($name2);
            $test_author2->save();

            //Act
            $result = Author::find($test_author->getId());

            //Assert
            $this->assertEquals($test_author, $result);
        }
    }
 ?>
