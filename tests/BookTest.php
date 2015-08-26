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
            $title = "Whimsical Fairytales and other stories";
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
            $title = "Whimsical Fairytales and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);

            //Act
            $result = $test_book->getGenre();

            //Assert
            $this->assertEquals($genre, $result);
        }

        function test_save()
        {
            //Arrange
            $title = "Whimsical Fairytales, and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);

            //Act
            $test_book->save();

            //Assert
            $result = Book::getAll();
            $this->assertEquals($test_book, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $title = "Whimsical Fairytales and Other Stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $title2 = "The Secret Life of Garden Gnomes";
            $genre2 = "Nonfiction";
            $test_book2 = new Book($title2, $genre2);
            $test_book2->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book, $test_book2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $title = "Whimsical Fairytales and Other Stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $title2 = "The Secret Life of Garden Gnomes";
            $genre2 = "Nonfiction";
            $test_book2 = new Book($title2, $genre2);
            $test_book->save();

            //Act
            Book::deleteAll();

            //Assert
            $result = Book::getAll();
            $this->assertEquals([], $result);
        }
    }

 ?>
