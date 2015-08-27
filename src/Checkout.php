<?php
    class Checkout
    {
        private $copy_id;
        private $patron_id;
        private $due_date;
        private $id;

        function __construct($copy_id, $patron_id, $due_date, $id = null)
        {
            $this->copy_id = $copy_id;
            $this->patron_id = $patron_id;
            $this->due_date = $due_date;
            $this->id = $id;
        }

        //getter and setters
        function getCopyId()
        {
            return $this->copy_id;
        }

        function getPatronId()
        {
            return $this->patron_id;
        }

        function getDueDate()
        {
            return $this->due_date;
        }

        function setDueDate($new_due_date)
        {
            $this->due_date = $new_due_date;
        }

        function getId()
        {
            return $this->id;
        }

        //database methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO checkouts (copy_id, patron_id, due_date) VALUES ({$this->getCopyId()}, {$this->getPatronId()}, '{$this->getDueDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update()
        {

        }

        function delete()
        {

        }

        // get list of all patrons that have checked out books
        function getPatrons()
        {

        }

        //static methods

        static function getAll()
        {
            $checkouts_query = $GLOBALS['DB']->query("SELECT * FROM checkouts;");
            $all_checkouts = array();
            foreach ($checkouts_query as $checkout) {
                $copy_id = $checkout['copy_id'];
                $patron_id = $checkout['patron_id'];
                $due_date = $checkout['due_date'];
                $id = $checkout['id'];
                $new_checkout = new Checkout($copy_id, $patron_id, $due_date, $id);
                array_push($all_checkouts, $new_checkout);
            }
            return $all_checkouts;
        }

        static function deleteAll()
        {
            $GLOBAL['DB']->exec("DELETE FROM checkouts;");
        }

        static function find()
        {

        }





    }


 ?>
