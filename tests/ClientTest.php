<?php
    /**
    * @backupGlobals disabled
    * @backupAtrributes disabled
    */
    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }
        function test_getClientName()
        {
            //Arrange
            $client_name = "Steve";
            $test_client = new Client($client_name, $id, $stylist_id);
            //Act
            $result = $test_client->getName();
            //Assert
            $this->assertEquals($client_name, $result);
        }

        function test_getId()
         {
             //Arrange
             $stylist_name = "Steve";
             $id = null;

             $test_stylist = new Stylist($stylist_name, $id, $stylist_id);
             $test_stylist->save();

             $client_name = "Jeff";
             $stylist_id = $test_stylist->getId();
             $test_client = new Client($client_name, $id, $stylist_id);
             $test_client->save();

             //Act
             $result = $test_client->getId();

             //Assert
             $this->assertEquals(true, is_numeric($result));
         }
         function test_getStylistId()
         {
             //Arrange
             $stylist_name = "Steve";
             $id = null;

             $test_stylist = new Stylist($stylist_name, $id);
             $test_stylist->save();

             $client_name = "Jeff";
             $stylist_id = $test_stylist->getId();
             $test_client = new Client($client_name, $id, $stylist_id);
             $test_client->save();

             //Act
             $result = $test_client->getStylistId();

             //Assert
             $this->assertEquals(true, is_numeric($result));
         }

         function test_save()
         {
            //Arrange
            $stylist_name = "Steve";
            $id = null;

            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Jeff";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $id, $stylist_id);

            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);
         }

         function test_getAll()
         {
             //Arrange
             $stylist_name = "Steve";
             $id = null;

             $test_stylist = new Stylist($stylist_name, $id);
             $test_stylist->save();

             $client_name = "Jeff";
             $stylist_id = $test_stylist->getId();
             $test_client = new Client($client_name, $id, $stylist_id);
             $test_client->save();

             $client_name2 = "Ralph";
             $stylist_id = $test_stylist->getId();
             $test_client2 = new Client($client_name2, $id, $stylist_id);
             $test_client2->save();

             //Act
             $result = Client::getAll();

             //Assert
             $this->assertEquals([$test_client, $test_client2], $result);
         }

         function test_deleteAll()
         {
             //Arrange
             $stylist_name = "Steve";
             $id = null;

             $test_stylist = new Stylist($stylist_name, $id);
             $test_stylist->save();

             $client_name = "Ralph";
             $stylist_id = $test_stylist->getId();
             $test_client = new Client($client_name, $id, $stylist_id);

             $client_name2 = "Potsi";
             $stylist_id = $test_stylist->getId();
             $test_client2 = new Client($client_name2, $id, $stylist_id);

             //Act
             Client::deleteAll();

             //Assert
             $result = Client::getAll();
             $this->assertEquals([], $result);
         }

         function test_find()
         {
             //Arrange
             $stylist_name = "Steve";
             $id = null;

             $test_stylist = new Stylist($stylist_name, $id);
             $test_stylist->save();

             $client_name = "Ralph";
             $stylist_id = $test_stylist->getId();
             $test_client = new Client($client_name, $id, $stylist_id);
             $test_client->save();

             $client_name2 = "Potsi";
             $stylist_id = $test_stylist->getId();
             $test_client2 = new Client($client_name2, $id, $stylist_id);
             $test_client2->save();

             //Act
             $id = $test_client->getId();
             $result = Client::find($id);

             //Assert
             $this->assertEquals($test_client, $results);
         }

         function test_updateClientName()
         {
             //Arrange
             $stylist_name = "Steve";
             $id = null;

             $test_stylist = new Stylist($stylist_name, $id);
             $test_stylist->save();

             $client_name = "Ralph";
             $stylist_id = $test_stylist->getId();
             $test_client = new Client($client_name, $id, $stylist_id);

             $new_client_name = "Potsi";

             //Act
             $test_client->updateClientName($new_client_name);

             //Assert
             $this->assertEquals("Potsi", $test_client->getClientName());
         }

         function test_delete()
         {
             //Arrange
             $stylist_name = "Steve";
             $id = null;
             
             $test_stylist = new Stylist($stylist_name, $id);
             $test_stylist->save();

             $client_name = "Ralph";
             $stylist_id = $test_stylist->getId();
             $test_client = new Client($client_name, $id, $stylist_id);
             $test_client->save();

             $client_name2 = "Potsi";
             $stylist_id = $test_stylist->getId();
             $test_client2 = new Client($client_name2, $id, $stylist_id);
             $test_client2->save();

             //Act
             $test_client->delete();

             //Assert
             $this->assertEquals([$test_client2], Client::getAll());
         }

    }
?>
