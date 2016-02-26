<?php

    Class Client
    {
        private $name;
        private $phone_number;
        private $id;
        private $stylist_id;

        function __construct($name, $phone_number, $id = null, $stylist_id)
        {
            $this->name = $name;
            $this->phone_number = $phone_number;
            $this->id = $id;
            $this->stylist_id = $stylist_id;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getName()
        {
            return $this->name;
        }

        function setPhone_number($phone_number)
        {
            $this->phone_number = $phone_number;
        }

        function getPhone_number()
        {
            return $this->phone_number;
        }

        function getId()
        {
            return $this->id;
        }

        function getStylist_Id()
        {
            return $this->stylist_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, phone_number, stylist_id) VALUES ('{$this->getName()}', '{$this->getPhone_number()}','{$this->getStylist_Id()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $phone_number = $client['phone_number'];
                $id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($name, $phone_number, $id, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
          $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }



    }

































?>
