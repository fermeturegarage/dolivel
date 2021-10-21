<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Dolivel\Api;

class DolivelController extends Controller
{
	public $dolivel;
	
	public function __construct()
	{
		$dolivel = new Api;
		$this->dolivel = $dolivel;
	}
	
}
