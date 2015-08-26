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
            $GLOBALS['DB']->exec("INSERT INTO patrons (name, phone) VALUES ('{$this->getName()}', '{$this->getPhone()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
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
            $patrons_query = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $all_patrons = array();
            foreach ($patrons_query as $patron) {
                $name = $patron['name'];
                $phone = $patron['phone'];
                $id = $patron['id'];
                $new_patron = new Patron($name, $phone, $id);
                array_push($all_patrons, $new_patron);
            }
            return $all_patrons;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons;");
        }

        static function find()
        {

        }
    }
?>
