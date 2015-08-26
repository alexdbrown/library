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

            //make an initial copy in copies table
            $GLOBALS['DB']->exec("INSERT INTO copies (book_id) VALUES ({$this->getId()});");
        }

        // method allows librarian to update both name and genre for a book
        function update($column_to_update, $new_info)
        {
            $GLOBALS['DB']->exec("UPDATE books SET {$column_to_update} = '{$new_info}' WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM books WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM copies WHERE book_id = {$this->getId()};");

        }

        //Author interaction methods
        function addAuthor($new_author)
        {
            $GLOBALS['DB']->exec("INSERT INTO books_authors (book_id, author_id) VALUES (
                {$this->getId()},
                {$new_author->getId()}
            );");
        }

        function getAuthors()
        {
            $authors_query = $GLOBALS['DB']->query(
                "SELECT authors.* FROM
                    books JOIN books_authors ON (books_authors.book_id = books.id)
                          JOIN authors       ON (books_authors.author_id = authors.id)
                WHERE books.id = {$this->getId()};
                "
            );
            $matching_authors = array();
            foreach ($authors_query as $author) {
                $name = $author['name'];
                $id = $author['id'];
                $new_author = new Author($name, $id);
                array_push($matching_authors, $new_author);
            }
            return $matching_authors;
        }

        // books - copies methods
        function addCopies($number_of_copies)
        {
            for($i = 1; $i <= $number_of_copies; $i++) {
                $GLOBALS['DB']->exec("INSERT INTO copies (book_id) VALUES ({$this->getId()});");
            }

        }

        // this makes a book for every copy, although it probably doesn't need to because
        // a list of some number of books with the same title and genre isn't really useful
        // to a librarian
        function getCopies()
        {
            $copies_query = $GLOBALS['DB']->query("SELECT * FROM copies WHERE book_id = {$this->getId()};");
            $matching_copies = array();
            foreach ($copies_query as $copy) {
                // $book_id = $copy['book_id'];
                $title = $this->getTitle();
                $genre = $this->getGenre();
                $id = $this->getId();
                $new_book = new Book($title, $genre, $id);
                array_push($matching_copies, $new_book);
            }
            return $matching_copies;
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
            $GLOBALS['DB']->exec("DELETE FROM books_authors;");
            $GLOBALS['DB']->exec("DELETE FROM copies;");

        }

        static function find($search_id)
        {
            $found_book = null;
            $all_books = Book::getAll();
            foreach ($all_books as $book) {
                if ($book->getId() == $search_id) {
                    $found_book = $book;
                }
            }
            return $found_book;
        }
    }
?>
