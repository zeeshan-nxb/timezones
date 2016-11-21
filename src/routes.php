<?php

Route::get('timezones/{timezone?}', 
  'nxb\timezones\TimezonesController@index');
