<?php

// $date = new DateTime();
// $timeZone = $date->getTimezone();
// echo $timeZone->getName();
// echo date_default_timezone_get();
echo date_default_timezone_get() ;
echo '</br>';
echo 'Default Timezone: ' . date('d-m-Y H:i:s') . '</br>';
date_default_timezone_set('Asia/Jakarta');
echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');

?>