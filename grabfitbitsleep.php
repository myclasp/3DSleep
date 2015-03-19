<?php
require 'fitbitphp/fitbitphp.php';
$fitbit = new FitBitPHP("", "");

$fitbit->initSession('http://callback');
//$xml = $fitbit->getProfile();

date_default_timezone_set('UTC');
$sleep = $fitbit->getSleep(new DateTime ( ) );


//print_r($sleep->sleep->sleepLog->minuteData->data[1]);
//print_r($sleep);

foreach ($sleep->sleep->sleepLog->minuteData->data as $mins){

        //print_r($mins->dateTime);
        //print_r($mins->value);


        $sleepQ[substr($mins->dateTime, 0, 2)] += $mins->value;


}



$hour = 0;

for ($i = 0; $i < count($sleep->sleep->sleepLog->minuteData->data); ++$i) {
        $sleepByHours[$hour]['count'] += $sleep->sleep->sleepLog->minuteData->data[$i]->value;
        $sleepByHours[$hour]['mins'] = $i - ($hour*60);
        $sleepByHours[$hour]['disturbed'] = ($sleepByHours[$hour]['count']-$sleepByHours[$hour]['mins']) / $sleepByHours[$hour]['mins'];

        if ((abs(($i/60) - round($i/60)) < 0.0001)&&($i>0)) {
                $hour++;
        }
    }


print_r($sleepQ);

print_r($sleepByHours);

?>

