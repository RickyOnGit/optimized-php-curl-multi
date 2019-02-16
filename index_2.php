<?php
/****************************************************************************************************************** 
In this example I have used the open data OF public transport of Palermo city: 
https://opendata.comune.palermo.it/opendata-dataset.php?dataset=1040  
available under the license: 
https://creativecommons.org/licenses/by-sa/4.0/deed.it, 
and the technical documentation of APIs in real time of the public road 
transport service in Palermo:  
https://docs.google.com/document/d/1Hli_2N8HIpIc1I4N4gEnCwROfMSnKlVt7EKCOz1Ovcw/edit#heading=h.frwtt8a5837h
it shows how php curl multi work with a rest api. 
In this example with the method GetStopArrivals of moovitapp REST API, 
it return 3 json because I did 3 simultaneous asynchronous calls with CURL POST protocol for the 
bus stops number 1258, 1259, 1260. 
The data are in real time, so in you make a page refresh you will see the data changed; the data will show for 
each bus stop the arrivals time of the buses. 
After the 22.00 (10.00 P.M.) you will see no data because there are no buses in circulation in Palermo 
city after the 22.00 o'clock. 
This is only a sample to show all the power of the php_curl_multi with a rest api from which you can take a cue. 

Sometimes this example response with internal server error due to many requests.

For demonstration purposes I have published an other example, view file index_3.php with the 
API's https://openlibrary.org/dev/docs/api/books that uses the GET method and retuns a json.
There's plenty of things you can do with rest API's, you're spoiled for choice: 
https://github.com/toddmotto/public-apis/blob/master/README.md
some others useful resources here: 
https://pdflayer.com/documentation , https://github.com/apilayer/pdflayer-API
https://codex.wordpress.org/WordPress_API%27s 
enjoy oneself   
*******************************************************************************************************************/
include_once("./lib/class.curlmulti.php"); 
$ref= new cURmultiStable;

$urllinkarray = array('https://api.moovitapp.com/services-app/services/EX/API/GetStopArrivals',
'https://api.moovitapp.com/services-app/services/EX/API/GetStopArrivals','https://api.moovitapp.com/services-app/services/EX/API/GetStopArrivals');

$postfield = array("{\n\t\"stopKey\": \"1258\"\n}", "{\n\t\"stopKey\": \"1259\"\n}", "{\n\t\"stopKey\": \"1260\"\n}");

$headers = array(array("api_key: amat_palermo_2317885288","content-type: application/json","user_loc: (38.115093,13.356520)"),
array("api_key: amat_palermo_2317885288","content-type: application/json","user_loc: (38.115093,13.356520)"), 
array("api_key: amat_palermo_2317885288","content-type: application/json","user_loc: (38.115093,13.356520)")); 

$urls = $ref->multicurlRestApi($urllinkarray, $postfield, $headers);

echo $urls[0];
echo "<br><br><br><br>";
echo $urls[1];
echo "<br><br><br><br>";
echo $urls[2];
?>