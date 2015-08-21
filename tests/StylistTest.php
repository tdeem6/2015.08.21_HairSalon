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

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }
        function test_getStylistName()
        {
            //Arrange
            $stylist_name = "Steve";
            $test_stylist = new Stylist($stylist_name);
            //Act
            $result = $test_stylist->getStylistName();
            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function test_getId()
        {
            //Arrange
            $stylist_name = "Steve";
            $id = 1;
            $test_stylist = new Stylist($stylist_name, $id);
            //Act
            $result = $test_stylist->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $stylist_name = "Steve";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            //Act
            $result = Stylist::getAll();
            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $stylist_name = "Steve";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $stylist_name2 = "Carl";
            $test_stylist2 = new Stylist($stylist_name2, $id);
            $test_stylist2->save();
            //Act
            $result = Stylist::getAll();
            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $stylist_name = "Steve";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $stylist_name2 = "Carl";
            $test_stylist2 = new Stylist($stylist_name2, $id);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_getClients()
       {
           //Arrange
           $stylist_name = "Steve";
           $id = null;
           $test_stylist = new Stylist($stylist_name, $id);
           $test_stylist->save();

           $test_stylist_id = $test_stylist->getId();
           $client_name = "Ralph";
           $test_client = new Client($client_name, $id, $test_stylist_id, $rating);
           $test_client->save();

           $client_name2 = "Potsi";
           $test_client2 = new Client($client_name, $id, $test_stylist_id, $rating);
           $test_client2->save();

           //Act
           $result = $test_stylist->getClients();

           //Assert
           $this->assertEquals([$test_client, $test_client2], $result);
       }
       function test_update()
       {
           //Arrange
           $stylist_name = "Steve";
           $id = null;
           $test_stylist = new Stylist($stylist_name, $id);
           $test_stylist->save();

           $new_stylist_name = "Carl";

           //Act
           $test_stylist->updateStylistName($new_stylist_name);

           //Assert
           $this->assertEquals("Carl", $test_stylist->getStylistName());
       }
       function test_delete()
       {
           //Arrange
           $stylist_name = "Steve";
           $id = null;
           $test_stylist = new Stylist($stylist_name, $id);
           $test_stylist->save();

           $stylist_name2 = "Carl";
           $test_stylist2 = new Stylist($stylist_name2, $id);
           $test_stylist2->save();

           //Act
           $test_stylist->delete();

           //Assert
           $this->assertEquals([$test_stylist2], Stylist::getAll());
       }

       function test_find()
       {
           //Arrange
           $stylist_name = "Steve";
           $test_stylist = new Stylist($stylist_name);
           $test_stylist->save();

           $stylist_name2 = "Jimmy";
           $test_stylist2 = new Stylist($stylist_name2);
           $test_stylist->save();

           //Act
           $result = Stylist::find($test_stylist2->getId());

           //Assert
           $this->assertEquals($test_stylist2, $result);
       }

       function test_deleteStylistClients()
       {
           //Arrange
           $stylist_name = "Steve";
           $id = null;
           $test_stylist = new Stylist($stylist_name, $id);
           $test_stylist->save();

           $client_name = "Frank";
           $id = null;
           $stylist_id = $test_stylist->getId();
           $test_client = new Client($client_name, $id, $stylist_id);
           $test_client->save();
           //Act
           $test_stylist->delete();
           //Assert
           $this->assertEquals([], Client::getAll());
       }




    }
?>
