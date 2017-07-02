<?php
$currentDir = getcwd();
$string = file_get_contents($currentDir."/appupdate.json");
$jsonDecoded = json_decode($string, true);
$jsonEncoded = json_encode($jsonDecoded);

// echo $string;
// echo "</br>";
echo $jsonEncoded;

// $jsonIterator = new RecursiveIteratorIterator(
//     new RecursiveArrayIterator($jsonDecoded),
//     RecursiveIteratorIterator::SELF_FIRST);

// foreach ($jsonIterator as $key => $val) {
//     if(is_array($val)) {
//         echo "$key:\n";
//     } else {
//         echo "$key => $val\n";
//     }
// }


?>