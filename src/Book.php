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

        }

        static function deleteAll()
        {

        }

        static function find()
        {

        }
    }
?>
