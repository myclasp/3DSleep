<?php
require 'fitbitphp/fitbitphp.php'; // from https://github.com/heyitspavel/fitbitphp
$fitbit = new FitBitPHP("", ""); //enter your key and secret

$fitbit->initSession('http://callback'); // add your callback, can be anything on your server
//$xml = $fitbit->getProfile();

date_default_timezone_set('UTC');
$sleep = $fitbit->getSleep(new DateTime ( ) );


foreach ($sleep->sleep->sleepLog->minuteData->data as $mins){

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

