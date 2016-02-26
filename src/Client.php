<?php

    Class Client
    {
        private $name;
        private $phone_number;
        private $id;
        private $stylist_id;

        function __construct($name, $phone_number, $id, $stylist_id)
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
    }

































?>
