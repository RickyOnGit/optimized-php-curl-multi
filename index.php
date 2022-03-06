/*** TEST FILE n 1 ***/

<?php
include_once("./lib/class.curlmulti.php"); 
$ref= new cURmultiStable;
$urllinkarray = array('http://php.net/manual/it/function.curl-multi-add-handle.php', 
'http://php.net/manual/en/function.curl-multi-init.php', 
'http://php.net/manual/en/function.curl-multi-setopt.php'
);
/* Since I like to stress the functions add an others request */
$q = true;
if ($q==true){
array_push($urllinkarray,"http://php.net/manual/it/function.curl-multi-close.php");
}
$urls = $ref->runmulticurl($urllinkarray);
foreach ($urls as $value){
echo $value; 
}
?>