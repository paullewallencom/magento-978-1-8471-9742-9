<?php
$client = new SoapClient('http://m.jhuskisson.com/api/soap/?wsdl');
$session = $client->login('Magentobook', 'Developersguide'); 
$client->endSession($session); 
?>