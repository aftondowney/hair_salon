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
              $stylist_name = "Sue";
              $id = null;
              $new_stylist = new Stylist($stylist_name, $id);
              $new_stylist->save();

              $name = "Anne";
              $phone_number = "(555)555-5555";
              $id = null;
              $stylist_id = $new_stylist->getId();
              $new_client = new Client($name, $phone_number, $id, $stylist_id);

              //Act
              $result = $new_client->getName();

              //Assert
              $this->assertEquals("Anne", $result);
          }

          function test_getPhone_number()
          {
              //Arrange
              $stylist_name = "Sue";
              $id = null;
              $new_stylist = new Stylist($stylist_name, $id);
              $new_stylist->save();

              $name = "Anne";
              $phone_number = "(555)555-5555";
              $id = null;
              $stylist_id = $new_stylist->getId();
              $new_client = new Client($name, $phone_number, $id, $stylist_id);

              //Act
              $result = $new_client->getPhone_number();

              //Assert
              $this->assertEquals("(555)555-5555", $result);
          }

          function test_getId()
          {
              //Arrange
              $stylist_name = "Sue";
              $id = null;
              $new_stylist = new Stylist($stylist_name, $id);
              $new_stylist->save();

              $name = "Anne";
              $phone_number = "(555)555-5555";
              $id = 1;
              $stylist_id = $new_stylist->getId();
              $new_client = new Client($name, $phone_number, $id, $stylist_id);

              //Act
              $result = $new_client->getId();

              //Assert
              $this->assertEquals(true, is_numeric($result));
          }

          function test_getStylist_id()
          {
              //Arrange
              $stylist_name = "Sue";
              $id = null;
              $new_stylist = new Stylist($stylist_name, $id);
              $new_stylist->save();

              $name = "Anne";
              $phone_number = "(555)555-5555";
              $id = 1;
              $stylist_id = $new_stylist->getId();
              $new_client = new Client($name, $phone_number, $id, $stylist_id);

              //Act
              $result = $new_client->getStylist_Id();

              //Assert
              $this->assertEquals(true, is_numeric($result));
          }

          function test_save()
          {
              //Arrange
              $stylist_name = "Sue";
              $id = null;
              $new_stylist = new Stylist($stylist_name, $id);
              $new_stylist->save();

              $name = "Anne";
              $phone_number = "(555)555-5555";
              $stylist_id = $new_stylist->getId();
              $new_client = new Client($name, $phone_number, $id, $stylist_id);

              //Act
              $new_client->save();

              //Assert
              $result = Client::getAll();
              $this->assertEquals($new_client, $result[0]);
          }
    }


















?>
