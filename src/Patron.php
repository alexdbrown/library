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
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function getId()
        {
            return $this->id;
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
