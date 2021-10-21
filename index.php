<?php
require 'vendor/autoload.php';

use App\Http\Controllers\PanierController;
use Dolivel\Api as Api;

$exemple = new Api();
echo $exemple->hello();

