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

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($new_stylist, $result[0]);
          }

          function test_getAll()
          {
              //Arrange
              $name = "Sue";
              $new_stylist = new Stylist($name);
              $new_stylist->save();

              $name2 = "Lisa";
              $new_stylist2 = new Stylist($name2);
              $new_stylist2->save();

              //Act
              $result = Stylist::getAll();

              //Assert
              $this->assertEquals([$new_stylist, $new_stylist2], $result);
          }

          function test_deleteAll()
          {
            //Arrange
            $name = "Sue";
            $new_stylist = new Stylist($name);
            $new_stylist->save();

            $name2 = "Lisa";
            $new_stylist2 = new Stylist($name2);
            $new_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
          }
    }

























?>
