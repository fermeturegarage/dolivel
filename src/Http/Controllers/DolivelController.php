<?php

namespace Fermeturegarage\Dolivel\Http\Controllers;

use Illuminate\Http\Request;

use Fermeturegarage\Dolivel\Api;

class DolivelController extends Controller
{
	public $dolivel;

	public function __construct()
	{
		$dolivel = new Api;
		$this->dolivel = $dolivel;
	}

}
