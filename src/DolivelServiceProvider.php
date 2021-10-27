<?php

namespace Fermeturegarage\Dolivel;

use Illuminate\Support\ServiceProvider;

class DolivelServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
        // Facades
        $this->app->bind('calculator', function($app) {
            return new Calculator();
        });

        $this->app->bind('api', function($app) {
            return new Api();
        });
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Routes
		$this->loadRoutesFrom(__DIR__.'/../routes/web.php');

		// Views
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'dolivel');

		// Publish
		if ($this->app->runningInConsole()) {
            // Publish Views
			$this->publishes([
				__DIR__.'/../resources/views' => resource_path('views/vendor/dolivel'),
			], 'views');

            // Publish Assets
			$this->publishes([
				__DIR__.'/../resources/assets' => public_path('dolivel'),
			], 'assets');
		}
	}
}
