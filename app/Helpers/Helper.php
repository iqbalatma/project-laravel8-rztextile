<?php 
function randomString($length):string
{
  return substr(md5(time()), 0, $length);
}
?>