<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', static function () {
    return 'test';
});

$appPath = app_path('Modules');
$modulesPath = scandir($appPath);
foreach ($modulesPath as $modulePath) {
    if (file_exists($filepath = $appPath . "/" . $modulePath . "/routes/web.php")) {
        require $filepath;
    }
    if (file_exists($filepath = $appPath . "/" . $modulePath . "/routes/api.php")) {
        require $filepath;
    }
    //the same for console and channels to have it "plug and play" indenpendent
    // I didn't put it because for this project I don't require them
}
