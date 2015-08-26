<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Author.php";
    require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
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

        function test_update()
        {
            //Arrange
            $name = "Ashlin Aronin";
            $test_author = new Author($name);
            $test_author->save();

            //Act
            $new_name = "Sassy Ash";
            $test_author->update($new_name);

            //Assert
            $this->assertEquals($new_name, $test_author->getName());
        }

        function test_delete()
        {
            //Arrange
            $name = "Ashlin Aronin";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Vincent Adultman";
            $test_author2 = new Author($name2);
            $test_author2->save();

            //Act
            $test_author->delete();

            //Assert
            $result = Author::getAll();
            $this->assertEquals($test_author2, $result[0]);
        }

        function test_addBook()
        {
            //Arrange
            $title = "Theory of Everything and Nothing at All";
            $genre = "Nonsense";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $name = "Pladoh";
            $test_author = new Author($name);
            $test_author->save();

            //Act
            $test_author->addBook($test_book);

            //Assert
            $this->assertEquals($test_author->getBooks(), [$test_book]);
        }

        function test_getBooks()
        {
            //Arrange
            $name = "Pladoh";
            $test_author = new Author($name);
            $test_author->save();

            $title = "Theory of Everything and Nothing at All";
            $genre = "Nonsense";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $title2 = "Philosoraptor: A Memoir";
            $genre2 = "Alternate History/Dinosaurs";
            $test_book2 = new Book($title, $genre);
            $test_book2->save();

            //Act
            $test_author->addBook($test_book);
            $test_author->addBook($test_book2);

            //Assert
            $this->assertEquals($test_author->getBooks(), [$test_book, $test_book2]);

        }
    }
 ?>
