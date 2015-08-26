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

        }

        function setName($new_name)
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

        }

        static function deleteAll()
        {

        }

        static function find()
        {

        }
    }
?>
