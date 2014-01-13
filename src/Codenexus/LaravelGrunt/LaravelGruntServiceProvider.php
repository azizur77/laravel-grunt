<?php namespace Codenexus\LaravelGrunt;

use Illuminate\Support\ServiceProvider;
use Codenexus\LaravelGrunt\Commands\GruntMakeCommand;

class LaravelGruntServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerMake();

		$this->registerCommands();
	}

	/**
	 * Register grunt.make
	 *
	 * @return Codenexus\Console\GruntMakeCommand
	 */
	protected function registerMake()
	{
		$this->app['grunt.make'] = $this->app->share(function($app)
		{
			return new GruntMakeCommand();
		});
	}

	/**
	 * Make commands visible to Artisan
	 *
	 * @return void
	 */
	protected function registerCommands()
	{
		$this->commands(
			'grunt.make'
		);
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('codenexus/laravel-grunt');
	}	

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}