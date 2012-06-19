<?php
// cache.log is a copy of chrome cache page with only the file content section
$cacheString = file_get_contents("cache.log");
$matches = array();
preg_match_all('/\s[0-9a-f]{2}\s/', $cacheString, $matches);
$f = fopen("t.bin","wb");
foreach ($matches[0] as $match)
{
  fwrite($f,chr(hexdec($match)));
}
fclose($f);
 
ob_start();
readgzfile("t.bin");
$decoded_data=ob_get_clean();
echo $decoded_data;
?>