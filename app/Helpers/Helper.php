<?php 
function randomString($length):string
{
  return substr(md5(time()), 0, $length);
}

function getIncreasedDigitNumber(string $paymentCodeNumber): string
{
  $exploded = explode('-', $paymentCodeNumber);
  $lastNumber = end($exploded);
  $number = str_pad(intval($lastNumber) + 1, strlen($lastNumber), '0', STR_PAD_LEFT);

  return $number;
}
?>