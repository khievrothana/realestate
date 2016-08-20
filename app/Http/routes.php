<?php

Route::get('/', function(){
    return 'hello world';
});

Route::group(['prefix' => 'administrator'], function() {

    Route::get('/', 'admin\HomeController@index');
    Route::get('/login', function(){
        return View('auth.login');
    });
    //Route::post('/dologin','Auth\AuthController@dologin');

    Route::get('/property','admin\PropertyController@index');
    Route::get('/property/GetList','admin\PropertyController@GetList');
    Route::get('/property/GetBoundList','admin\PropertyController@GetBoundList');
    Route::post('/property/Save','admin\PropertyController@Save');
    Route::post('/property/Update','admin\PropertyController@Update');
    Route::get('/property/Delete','admin\PropertyController@Delete');
    Route::get('/property/Detail','admin\PropertyController@Detail');

    Route::get('/property/addnew',function(){ 
    	return View('admin.property.edit');
    });
     Route::get('/property/edit/{id}',function(){ 
        return View('admin.property.edit');
    });

    Route::get('/property/location',function(){ 
    	return View('admin.property.location');
    });
    Route::get('/property/type',function(){ 
    	return View('admin.property.type');
    });
    Route::get('/property/GetPropertyType','admin\PropertyController@GetPropertyType');
    Route::post('/property/type/addnew','admin\PropertyController@SavePropertyType');
    Route::post('/property/type/update','admin\PropertyController@UpdatePropertyType');
    Route::get('/property/type/Delete','admin\PropertyController@DeletePropertyType');

    Route::get('/property/feature',function(){ 
        return View('admin.property.feature');
    });
    
	Route::get('/image','admin\ImageController@index');
	Route::get('/image/upload','admin\ImageController@upload');
	Route::get('/image/GetList','admin\ImageController@GetList');
	Route::get('/image/Delete','admin\ImageController@Delete');
});

Route::post('/image/upload','admin\ImageController@upload');
Route::get('/image/GetList','admin\ImageController@GetList');
Route::get('/image/Delete','admin\ImageController@Delete');
Route::get('/location/GetListProvince', 'LocationController@ListProvince');
Route::get('/location/GetListDistrict', 'LocationController@ListDistrict');
Route::get('/location/GetListCommune', 'LocationController@ListCommune');
Route::get('/location/GetListVillage', 'LocationController@ListVillage');
Route::get('/location/GetDistrictByProvinceId','LocationController@GetDistrictByProvinceId');
Route::get('/location/GetCommuneByDistrictId','LocationController@GetCommuneByDistrictId');
Route::get('/location/GetVillageByCommuneId','LocationController@GetVillageByCommuneId');