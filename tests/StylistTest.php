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

    class StylistTest extends PHPUnit_Framework_TestCase
    {

          protected function teardown()
          {
            Stylist::deleteAll();
            // Client::deleteAll();
          }

          function test_save()
          {
            //Arrange
            $name = "Sue";
            $new_stylist = new Stylist($name);
            $new_stylist->save();

            //Array
            $result = Stylist::getAll();

            //assert
            $this->assertEquals($new_stylist, $result[0]);
          }
    }




?>
