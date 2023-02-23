<?php 

function getDrivers() {
  $drivers = json_decode(file_get_contents(__DIR__.'/drivers.json'), true);
  // Filter the array to only include active drivers
  $activeDrivers = array_filter($drivers, function($driver) {
      return isset($driver['activeDriver']) && $driver['activeDriver'] == true;
  });
  return $activeDrivers;
}

function getInactiveDrivers() {
  $drivers = json_decode(file_get_contents(__DIR__.'/drivers.json'), true);

  $inactiveDrivers = array_filter($drivers, function($driver) {
    return !$driver['activeDriver'];
  });

  return array_values($inactiveDrivers);
}



function getDriverById($id) {

}

function createDriver($data) {

}

function updateDriver($data, $id) {

}

function deleteDriver($id) {

}

?>