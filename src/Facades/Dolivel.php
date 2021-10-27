<?php

namespace Fermeturegarage\Dolivel\Facades;

use Illuminate\Support\Facades\Facade;

class Dolivel extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'api';
	}
}
