<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.','middleware' => ['web','adminaccess'] ],function () {
    Route::get('', function () { return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard', function () { return view('admin.index'); })->name('dashboard');
    Route::resource('event', 'EventController');
    Route::resource('artist', 'ArtistController');
    Route::resource('sermon', 'SermonController');
    Route::resource('media', 'MediaController');
    Route::get('file-manager', function () {
        return view('admin.media.file-manager');
    })->name('media.filemanager');

    Route::resource('venue', 'VenueController');
    Route::resource('page', 'PageController');
    Route::post('media/imageUpload', 'MediaController@imageUpload')->name('media.imageUpload');
    Route::resource('tag', 'TagController')->except([
      'create', 'show', 'edit'
    ]);
    Route::post('/event/sermon/', 'SermonController@storeAjax')->name('event.sermon');
});


Route::get('/', 'HomeController@index')->name('home');

Route::group([ 'as' => 'front.','middleware' => ['web']],function () {
    Route::get('events', 'FrontController@events')->name('events');
    Route::get('event/{slug}', 'FrontController@event')->name('event');
    Route::get('artists', 'FrontController@artists')->name('artists');
    Route::get('artist/{id}', 'FrontController@artist')->name('artist');
    Route::get('sermons', 'FrontController@sermons')->name('sermons');
    Route::get('sermon/{slug}', 'FrontController@sermon')->name('sermon');
    Route::get('media', 'FrontController@media')->name('media');
    Route::get('tag/{tag}', 'FrontController@tag')->name('tag');
    Route::get('page/{pg}', 'FrontController@page')->name('page');
});
Route::get('gallery/image/{source}', function($source){
    return gallery_preview( $source );
})->name('view.gallery.image');
