<?php
/* this is an other sample with the API of  https://openlibrary.org/dev/docs/api/books 
this example search for books through ISBN 10 or  ISBN 13 and return a json file */

include_once("./lib/class.curlmulti.php"); 
$ref= new cURmultiStable;
$urllinkarray = array('https://openlibrary.org/api/books?bibkeys=ISBN:9780980200447&jscmd=data&format=json',
'https://openlibrary.org/api/books?bibkeys=ISBN:0451526538&jscmd=data&format=json',
'https://openlibrary.org/api/books?bibkeys=ISBN:9789573318316&jscmd=data&format=json');

$urls = $ref->runmulticurl($urllinkarray);
foreach ($urls as $value){
echo $value."<br><br><br>"; 
}


?>