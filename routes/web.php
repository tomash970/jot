<?php

Auth::routes();

Route::get('/logout-manual', function() {
	request()->session()->invalidate();
});

Route::get('/{any}', 'AppController@index')->where('any', '.*');
//u prethodnom  točka označava bilo koji caracter dok zvjezdica označava puta koliko - u ovom slučaju beskonačno mnogo
