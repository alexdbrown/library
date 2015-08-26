<?php
    class Patron
    {
        private $name;
        private $phone;
        private $id;

        function __construct($name, $phone, $id = null)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->id = $id;
        }

        //getters and setters
        function getName()
        {

        }

        function setName($new_name)
        {

        }

        function getPhone()
        {

        }

        function setPhone($phone)
        {

        }

        function getId()
        {

        }

        //database methods
        function save()
        {

        }

        function update($column_to_update, $new_info)
        {

        }

        function delete()
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
