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

        }

        function delete()
        {

        }

        //Book interaction methods
        function addBook($book)
        {

        }

        function getBooks()
        {

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
