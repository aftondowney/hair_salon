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

      static function getAll()
      {
          $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
          $stylists = array();
          foreach ($returned_stylists as $stylist)
          {
              $name = $stylist['name'];
              $id = $stylist['id'];
              $new_stylist = new Stylist($name, $id);
              array_push($stylists, $new_stylist);
          }
          return $stylists;
      }

      static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE FROM stylists;");
      }
    }










?>
