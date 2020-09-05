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

use App\Components\XornService;

Route::get('/test', function () {
    $xorn = new XornService('176.9.107.30', 9988, 'xornuser', 'xornpassword');

    echo '<b>getBlockchainInfo</b><br>';
    var_dump($xorn->getBlockchainInfo());

    echo '<b>listAccounts</b><br>';
    var_dump($xorn->listAccounts(6));

    echo '<b>listTransactions</b><br>';
    var_dump($xorn->listTransactions('*', 20, 100));
});