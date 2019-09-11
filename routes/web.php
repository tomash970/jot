<?php

Auth::routes();

Route::get('/{any}', 'AppController@index')->where('any', '.*');
//u prethodnom  točka označava bilo koji caracter dok zvjezdica označava puta koliko - u ovom slučaju beskonačno mnogo
