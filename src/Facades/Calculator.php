<?php

namespace Fermeturegarage\Dolivel\Facades;

use Illuminate\Support\Facades\Facade;

class Calculator extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'calculator';
	}
}
