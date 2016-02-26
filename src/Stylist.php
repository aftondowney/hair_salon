<?php

    class Stylist
    {
      private $name;
      private $id;

      function __construct($name, $id = NULL)
      {
          $this->name = $name;
          $this->id = $id;
      }

      function setName($name)
      {
          $this->name = $name;
      }

      function getName()
      {
          return $this->name;
      }

      function getId()
      {
          return $this->id;
      }

      function save()
      {
        $GLOBALS['DB']->query("INSERT INTO stylists (name) VALUES ('{$this->name}')");
        $this->id = $GLOBALS['DB']->lastInsertId();
      }
    }

?>
