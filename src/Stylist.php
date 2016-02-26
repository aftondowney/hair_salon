<?php

    class Stylist
    {
      private $name;
      private $id;

      function __construct($name, $id = null)
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
          $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->name}');");
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

      static function find($search_id)
      {
        $found_stylist = null;
        $stylists = Stylist::getAll();
        foreach($stylists as $stylist) {
            $stylist_id = $stylist->getId();
            if ($stylist_id == $search_id) {
                $found_stylist = $stylist;
            }
        }
        return $found_stylist;
      }

      function delete()
      {
          $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
      }

      function update($new_name)
      {
          $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
          $this->setName($new_name);
      }

      function getClients()
      {
          $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
          $clients = array();
          foreach($returned_clients as $client) {
              $name = $client['name'];
              $phone_number = $client['phone_number'];
              $stylist_id = $client['stylist_id'];
              $id = $client['id'];
              $new_client = new Client($name, $phone_number, $id, $stylist_id);
              array_push($clients, $new_client);
          }
          return $clients;
      }

      }






















?>
