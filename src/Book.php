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

        }

        function setTitle($new_title)
        {

        }

        function getGenre()
        {

        }

        function setGenre($new_genre)
        {

        }

        function getId()
        {

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
