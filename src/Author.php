<?php
    class Author
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        //getters and setters
        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        //database methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO authors (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE authors SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors WHERE id = {$this->getId()};");
        }

        //Book interaction methods
        function addBook($book)
        {
            $GLOBALS['DB']->exec("INSERT INTO books_authors (book_id, author_id) VALUES (
                {$book->getId()},
                {$this->getId()}
            );");
        }

        function getBooks()
        {
            $books_query = $GLOBALS['DB']->query(
                "SELECT books.* FROM
                    authors JOIN books_authors ON (books_authors.author_id = authors.id)
                            JOIN books         ON (books_authors.book_id = books.id)
                WHERE authors.id = {$this->getId()};
                "
            );
            $matching_books = array();
            foreach ($books_query as $book)  {
                $title = $book['title'];
                $genre = $book['genre'];
                $id = $book['id'];
                $new_book = new Book($title, $genre, $id);
                array_push($matching_books, $new_book);
            }
            return $matching_books;
        }

        //static methods
        static function getAll()
        {
            $authors_query = $GLOBALS['DB']->query("SELECT * FROM authors;");
            $all_authors = array();
            foreach ($authors_query as $author) {
                $name = $author['name'];
                $id = $author['id'];
                $new_author = new Author($name, $id);
                array_push($all_authors, $new_author);
            }
            return $all_authors;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors;");
            $GLOBALS['DB']->exec("DELETE FROM books_authors;");
        }

        static function find($search_id)
        {
            $found_author = null;
            $authors = Author::getAll();
            foreach ($authors as $author) {
                if ($author->getId() == $search_id) {
                    $found_author = $author;
                }
            }
            return $found_author;
        }
    }
?>
