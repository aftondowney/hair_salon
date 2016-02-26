<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
  	$username = 'root';
  	$password = 'root';
  	$DB = new PDO($server, $username, $password);

    require_once 'src/Stylist.php';
    require_once 'src/Client.php';

    class ClientTest extends PHPUnit_Framework_TestCase
    {

          protected function teardown()
          {
            Stylist::deleteAll();
            // Client::deleteAll();
          }

          function test_getName()
          {
              //Arrange
              $name = "Sue";
              $new_stylist = new Stylist($name);

              //Act
              $result = $new_stylist->getName();

              //Assert
              $this->assertEquals($name, $result);
          }
    }


















?>
