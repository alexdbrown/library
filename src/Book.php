<?php
    class Book
    {
        private $title;
        private $genre;
        private $id;

        function __construct($title, $genre, $id = null)
        {
            $this->title = $title;
            $this->genre = $genre;
            $this->id = $id;
        }

        //getters and setters
        function getTitle()
        {
            return $this->title;
        }

        function setTitle($new_title)
        {
            $this->title = (string) $new_title;
        }

        function getGenre()
        {
            return $this->genre;
        }

        function setGenre($new_genre)
        {
            $this->genre = (string) $new_genre;
        }

        function getId()
        {
            return $this->id;
        }

        //database methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO books (title, genre) VALUES(
                '{$this->getTitle()}',
                '{$this->getGenre()}'
            );");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_name)
        {

        }

        function delete()
        {

        }

        //Author interaction methods
        function addAuthor($new_author)
        {

        }

        function getAuthors()
        {

        }

        //static methods
        static function getAll()
        {
            $books_query = $GLOBALS['DB']->query("SELECT * FROM books;");
            $all_books = array();
            foreach ($books_query as $book) {
                $title = $book['title'];
                $genre = $book['genre'];
                $id = $book['id'];
                $new_book = new Book($title, $genre, $id);
                array_push($all_books, $new_book);
            }
            return $all_books;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books;");
        }

        static function find()
        {

        }
    }
?>
