<?php
/**
 * Created by PhpStorm.
 * User: randyjp
 * Date: 4/16/15
 * Time: 3:50 PM
 */

class BeerService  {

    const WSDL = "http://simon.ist.rit.edu:8080/beer/BeerService?wsdl";
    private $client;

    function __construct(){
        $options = array(
            "trace" =>1,
            "exception"=>1
        );

        try {
            $this->client = new SoapClient(BeerService::WSDL, $options);
        }
        catch(SoapFault $e){
            echo "Error with Soap";
            var_dump($e);
        }
    }

    public function getMethods()
    {

        try {
            $methods =  $this->client->getMethods();
        }
        catch(SoapFault $e){
            echo "Error with Soap";
            var_dump($e);
        }

        return "Methods are: " .  implode(",",$methods->return);
    }
    public function getPrice($beer_name){

        $params = array("arg0" =>$beer_name);

        try {

            return "The price for " . $beer_name . " is: $" . $this->client->getPrice($params)->return;
        }
        catch(SoapFault $e){
            echo "Error with Soap";
            var_dump($e);
        }
    }
    public function getBeers($toPrint =false){
        try {

            $beers = $this->client->getBeers();
        }
        catch(SoapFault $e){
            echo "Error with Soap";
            var_dump($e);
        }

        if($toPrint) return "Available beers: " . implode(",",$beers->return);
        return implode(",",$beers->return);
    }
    public function getCheapest(){
        try {

            return "The cheapest beer is: " . $this->client->getCheapest()->return;
        }
        catch(SoapFault $e){
            echo "Error with Soap";
            var_dump($e);
        }
    }
    public function getCostliest(){
        try {

            return "The costliest beer is: " . $this->client->getCostliest()->return;
        }
        catch(SoapFault $e){
            echo "Error with Soap";
            var_dump($e);
        }
    }

}