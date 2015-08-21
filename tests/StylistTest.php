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
        // protected function tearDown()
        // {
        //     Stylist::deleteAll();
        //     Client::deleteAll();
        // }
        function test_getName()
        {
            //Arrange
            $name = "Steve";
            $test_stylist = new Stylist($name);
            //Act
            $result = $test_stylist->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Steve";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            //Act
            $result = $test_stylist->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

    }
?>
