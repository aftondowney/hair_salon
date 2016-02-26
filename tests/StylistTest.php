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
          function test_getId()
          {
              //Arrange
              $name = "Sue";
              $id = 1;
              $new_stylist = new Stylist($name, $id);

              //Act
              $result = $new_stylist->getId();

              //Assert
              $this->assertEquals(true, is_numeric($result));
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

          function test_find()
          {
              //Arrange
              $name = "Sue";
              $new_stylist = new Stylist($name);
              $new_stylist->save();

              //Act
              $result = Stylist::find($new_stylist->getId());

              //Assert
              $this->assertEquals($new_stylist, $result);
          }

          function test_delete()
          {
              //Arrange
              $name = "Sue";
              $new_stylist = new Stylist($name);
              $new_stylist->save();

              $name2 = "Lisa";
              $new_stylist2 = new Stylist($name2);
              $new_stylist2->save();

              //Act
              $new_stylist->delete();
              $result = Stylist::getAll();

              //Assert
              $this->assertEquals([$new_stylist2], $result);
          }

          function test_update()
          {
              //Arrange
              $name = "Sue";
              $id = null;
              $test_stylist = new Stylist($name, $id);
              $test_stylist->save();

              $new_name = "Susan";

              //Act
              $test_stylist->update($new_name);

              //Assert
              $this->assertEquals("Susan", $test_stylist->getName());
          }
    }

























?>
