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

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
        }

        function test_getTitle()
        {
            //Arrange
            $title = "Whimsical Fairytales...and other stories";
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
            $title = "Whimsical Fairytales...and other stories";
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
            $title = "Whimsical Fairytales...and other stories";
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
            $title = "Whimsical Fairytales...and other stories";
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
            $title = "Whimsical Fairytales...and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $title2 = "The Secret Life of Garden Gnomes";
            $genre2 = "Nonfiction";
            $test_book2 = new Book($title2, $genre2);
            $test_book2->save();

            //Act
            Book::deleteAll();

            //Assert
            $result = Book::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $title = "Whimsical Fairytales...and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $title2 = "The Secret Life of Garden Gnomes";
            $genre2 = "Nonfiction";
            $test_book2 = new Book($title2, $genre2);
            $test_book2->save();

            //Act
            $result = Book::find($test_book->getId());

            //Assert
            $this->assertEquals($test_book, $result);
        }

        // test that update method is working for name
        function test_updateName()
        {
            //Arrange
            $title = "Whimsical Fairytales...and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $column_to_update = "title";
            $new_info = "Generic Fantasy Novel";

            //Act
            $test_book->update($column_to_update, $new_info);

            //Assert
            $result = Book::getAll();
            $this->assertEquals("Generic Fantasy Novel", $result[0]->getTitle());
        }

        // test that update method is working for genre
        function test_updateGenre()
        {
            //Arrange
            $title = "Whimsical Fairytales...and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $column_to_update = "genre";
            $new_info = "Historical Fiction";

            //Act
            $test_book->update($column_to_update, $new_info);

            //Assert
            $result = Book::getAll();
            $this->assertEquals("Historical Fiction", $result[0]->getGenre());
        }

        function test_delete()
        {
            //Arrange
            $title = "Whimsical Fairytales...and other stories";
            $genre = "Fantasy";
            $test_book = new Book($title, $genre);
            $test_book->save();

            $title2 = "The Secret Life of Garden Gnomes";
            $genre2 = "Nonfiction";
            $test_book2 = new Book($title2, $genre2);
            $test_book2->save();

            //Act
            $test_book->delete();

            //Assert
            $result = Book::getAll();
            $this->assertEquals($test_book2, $result[0]);
        }

        function test_addAuthor()
        {
            //Arrange
            $name = "Giacomo Bordello";
            $test_author = new Author($name);
            $test_author->save();

            $title = "Clarinet Seduction";
            $genre = "Romance";
            $test_book = new Book($title, $genre);
            $test_book->save();

            //Act
            $test_book->addAuthor($test_author);

            //Assert
            $this->assertEquals($test_book->getAuthors(), [$test_author]);
        }

        function test_getAuthors()
        {
            //Arrange
            $name = "Giacomo Bordello";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Dude Guy";
            $test_author2 = new Author($name2);
            $test_author2->save();

            $title = "Clarinet Seduction";
            $genre = "Romance";
            $test_book = new Book($title, $genre);
            $test_book->save();

            //Act
            $test_book->addAuthor($test_author);
            $test_book->addAuthor($test_author2);

            //Assert
            $this->assertEquals($test_book->getAuthors(), [$test_author, $test_author2]);
        }

        //test for method that adds another copy to an already existing book
        function test_addCopies()
        {
            //Arrange
            $title = "Gardening with Phil";
            $genre = "Informational/How-To";
            $test_book = new Book($title, $genre);
            $test_book->save();

            //Act
            $test_book->addCopies(1);

            //Assert
            $result = $test_book->getCopyIds();
            $this->assertEquals(2, count($result));
        }

        function test_getCopyIds()
        {
            //Arrange
            $title = "Gardening with Phil";
            $genre = "Informational/How-To";
            $test_book = new Book($title, $genre);
            $test_book->save();
            $test_book->addCopies(2);

            //Act
            $result = $test_book->getCopyIds();

            //Assert
            $this->assertEquals([$test_book, $test_book, $test_book], $result);
        }
    }

 ?>
