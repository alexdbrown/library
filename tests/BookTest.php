<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //require_once "src/Author.php";
    require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            //Author::deleteAll();
            Book::deleteAll();
        }

        function test_getTitle()
        {
            //Arrange
            $title = "Whimsical Fairytales, and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);

            //Act
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }

        function test_getGenre()
        {
            //Arrange
            $title = "Whimsical Fairytales, and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);

            //Act
            $result = $test_book->getGenre();

            //Assert
            $this->assertEquals($genre, $result);
        }
    }

 ?>
