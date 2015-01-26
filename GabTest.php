<?php

require 'inc/config.php';
require 'inc/class.db.php';
require 'nest-api-master/nest.class.php';

define('USERNAME', $config['nest_user']);
define('PASSWORD', $config['nest_pass']);

date_default_timezone_set($config['local_tz']);

$nest = new Nest();

/*
 * Get the data we  want to use
 */

// Nest data
$infos = $nest->getDeviceInfo();
printf("<br>Last Connection = %s\n", $infos->network->last_connection);
printf("<br>Mode = %s\n",$infos->current_state->mode);
printf("<br>Target temp = %s\n",$infos->target->temperature);
printf("<br>Current temp = %s\n",$infos->current_state->temperature);
printf("<br>Current Humidity = %s\n",$infos->current_state->humidity);

printf("<p>");

$locations = $nest->getUserLocations();
printf("<br>Name = %s\n",$locations[0]->name);
printf("<br>Postcal code = %s\n",$locations[0]->postal_code);
printf("<br>Country = %s\n",$locations[0]->country);
printf("<br>Away = %s\n",$locations[0]->away);

$CelOrFahr = $nest->getDeviceTemperatureScale();

/*
 * How to find your City ID on OpenWeatherMap.org: http://openweathermap.org/find?q=
 */

$jsonurl = "http://api.openweathermap.org/data/2.5/weather?q=" . $locations[0]->postal_code . "," . $locations[0]->country;
printf($jsonurl);
$json = file_get_contents($jsonurl);
$weather = json_decode($json);


printf("City : %s\n",$weather->name);

printf("Weer : %s\n", $weather->weather[0]->main);
printf("Weer omschrijving: %s\n", $weather->weather[0]->description);


$kelvin = $weather->main->temp;
$celcius = $kelvin - 273.15;
printf("<br>Outside Temp: %s\n",$celcius);
printf("<br>Outside Humidity: %s\n",$weather->main->humidity);
printf("<br>Outside Temp Min: %s\n",$weather->main->temp_min - 273.15);
printf("<br>Outside Temp Max: %s\n",$weather->main->temp_max - 273.15);
printf("<br>Outside Pressure: %s\n",$weather->main->pressure);

printf("<br>Wind Speed: %s\n",$weather->wind->speed);
printf("<br>Wind Directions: %s\n",$weather->wind->deg);



try {
  $db = new DB($config);
  
  $sqlString = "INSERT INTO rawdata( timestamp, name, updated, current, target, humidity, heating, postal_code, country, away, w_main, w_description, w_temp, w_humidity, w_tempmin, w_tempmax, w_pressure, w_windspeed, w_winddeg, w_name) "
          . " VALUES( $now(), "
          . $location[0]->name . ", "
          . $info->network->last_connection . ", "
          . $info->current_state->temperature . ", "
          . $info->target->temperature  . ", "
          . $info->current_state->humidity . ", "
          . $info->current_state->mode . ", "
          . $location[0]->postal_code . ", "
          . $location[0]->country . ", "
          . $location[0]->away . ", "
          . $weather->weather[0]->main . ", "
          . $weather->weather[0]->description . ", "
          . $weather->main->temp . ", "
          . $weather->main->humidity . ", "
          . $weather->main->temp_min . ", "
          . $weather->main->temp_max . ", "
          . $weather->main->pressure . ", "
          . $weather->wind->speed . ", "
          . $weather->wind->deg . ", "
          . $weather->name . ")" ;
  
  
  printf( $sqlString);
  
  //  $data = array('heating'      => ($info->current_state->heat == 1 ? 1 : 0),);
  
  
  /*
  if (!empty($data['timestamp'])) {
    if ($stmt = $db->res->prepare("REPLACE INTO data (timestamp, heating, cooling, fan, autoAway, manualAway, leaf, target, current, humidity, updated) VALUES (?,?,?,?,?,?,?,?,?,?,NOW())")) {
      $stmt->bind_param("siiiiiiddi", $data['timestamp'], $data['heating'], $data['cooling'], $data['fan'], $data['autoAway'], $data['manualAway'], $data['leaf'], $data['target_temp'], $data['current_temp'], $data['humidity']);
      $stmt->execute();
      $stmt->close();
    }
  }
   * 
   */
  
  $db->close();
} catch (Exception $e) {
  $errors[] = ("DB connection error! <code>" . $e->getMessage() . "</code>.");
}


?>

timestamp, updated, current, target, humidity, heating, postal_code, country, away, w_main, w_description, w_temp, w_humidity, w_tempmin, w_tempmax, w_pressure, w_windspeed, w_winddeg, w_name


$now(), $location[0]->name, $info->network->last_connection, $info->current_state->temperature, $info->target->temperature, $info->current_state->humidity, $info->current_state->mode, $location[0]->postal_code, $location[0]->country, $location[0]->away, $weather->weather[0]->main, $weather->weather[0]->description, $weather->main->temp, $weather->main->humidity, $weather->main->temp_min, $weather->main->temp_max, $weather->main->pressure, $weather->wind->speed, $weather->wind->deg, $weather->name