# Optimized-php-curl-multi
Fast and optimized php curl multi request for rest api

#Author Riccardo Castagna

#email: 3315954155@libero.it

#cUrl Multi fast simple and stable.

https://www.phpclasses.org/package/10875-PHP-Retrieve-the-content-of-multiple-URLs-using-CURL.html

The cUrl_extension is one of the most important extensions of the PHP especially when we have to interface with external APIs and we must communicate with other applications.

During a project that I was carrying out, where I needed to make multiple and simultaneous asynchronous requests, I came across a problem with the cUrl_Multi, which, after some vain but useful research, some analysis and many tests I developed a solution through an insight.

The problem is when you use the cUrl Multi with arrays to add the handles, because it can cause the loss of some requests.
 
Well, sometime the solutions are complex and sometime are simple.

In this case, the cUrl Multi, adding a simple solution during the execution of the first loop to add the handles, became stable.   

The problem has been in how the array with the cURL handles was executed, 
in fact if the loop of the array is executed normally all together, from the key number zero to the key number (n)keys, the cUrl multi, sometime, could returns errors or loses some hits.

The solution, I found, is to detach the first key adding the first handle to it without a loop, than executing the first loop, to add the handles, for the subsequent keys. 
All the requests will still remain anyway simultaneous because they are performed by the second loop with the curl_multi_exec.

In this way is very stable, light and fast. I have stressed very much this class with several tests, and it never lost a beat.

About this topic I wrote also something here:
"3315954155 at libero dot it" 
http://php.net/manual/it/function.curl-multi-add-handle.php#122964

As default options inside the main class there are:

curl_setopt($x, CURLOPT_URL, $y);<br>
curl_setopt($x, CURLOPT_HEADER, 0);<br>
curl_setopt($x, CURLOPT_FOLLOWLOCATION, 1);<br>
curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);<br>
// curl_setopt($x, CURLOPT_TCP_FASTOPEN, 1);<br>  
/* UNCOMMENT THE LINE ABOVE ONLY IF LIBCURL VERSION IS EQUAL OR GRATER THAN 7.49.0 */<br>
curl_setopt($x, CURLOPT_ENCODING, "gzip,deflate");<br>
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, 0);<br>
curl_setopt($x, CURLOPT_SSL_VERIFYHOST, 0);<br>

obviously you can change this options, according to your needs and according
to your libcurl version (view: https://curl.haxx.se/libcurl/c/symbols-in-versions.html) 
editing the main class file: ./lib/class.curlmulti.php  
private function set_option($x, $y)  
--------------------------------------------------------------------------------------------
Usage:
 
include_once("./lib/class.curlmulti.php"); 
$ref= new cURmultiStable;

$urllinkarray = array('http://php.net/manual/it/function.curl-multi-add-handle.php', 
'http://php.net/manual/en/function.curl-multi-init.php', 
'http://php.net/manual/en/function.curl-multi-setopt.php'
);

$urls = $ref->runmulticurl($urllinkarray);

foreach ($urls as $value){
echo $value; 
}
----------------------------------------------------------------------------------------------

OR:

include_once("./lib/class.curlmulti.php"); 
$ref= new cURmultiStable;

$urllinkarray = array('http://php.net/manual/it/function.curl-multi-add-handle.php', 
'http://php.net/manual/en/function.curl-multi-init.php', 
'http://php.net/manual/en/function.curl-multi-setopt.php'
);

$urls = $ref->runmulticurl($urllinkarray);

echo $urls[0],$urls[1],$urls[2];  
---------------------------------------------------------------------------------------------- 
OR:

include_once("./lib/class.curlmulti.php"); 
$ref= new cURmultiStable;

$urls = $ref->runmulticurl(array('http://php.net/manual/it/function.curl-multi-add-handle.php', 
'http://php.net/manual/en/function.curl-multi-init.php', 
'http://php.net/manual/en/function.curl-multi-setopt.php'
));

echo $urls[0],$urls[1],$urls[2];
----------------------------------------------------------------------------------------------
OR for a single request:

include_once("./lib/class.curlmulti.php"); 
$ref= new cURmultiStable;

$urls = $ref->runmulticurl(array('http://php.net/manual/it/function.curl-multi-add-handle.php#122964'));

echo $urls[0]; 
//or 
foreach ($urls as $value){
echo $value; 
}
---------------------------------------------------------------------------------------------- 

There are 3 example file:

1) index.php
2) index2.php 
3) index3.php

index.php and index3.php are simple multi requests to some endpoint through the function "runmulticurl($urlarray);" where $urlarray is the array of the endpoints.

index2.php is an example using multi requests to the rest api of the open data of public transport of Palermo city to get information about three bus stops concurrently, through the function "multicurlRestApi($urlarray, $postfield, $headers);" set in php class file class.curlmulti.php.

---------------------------------------------------------------------------------------------
EXAMPLE 2: index2.php

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
echo "<br>";
echo $urls[1];
echo "<br>";
echo $urls[2];
----------------------------------------------------------------------------------------------
Simple, fast and easy ... And no CPU problems !!! 
