<?php namespace Codenexus\LaravelGrunt\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;

class GruntMakeCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'grunt:make';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make a new Gruntfile';

	/**
	 * Plugin builder
	 *
	 * @var Codenexus\LaravelGrunt\Plugin
	 */
	protected $plugin;

	/**
	 * Path to assets directory
	 *
	 * @var string
	 */
	protected $assetsPath;

	/**
	 * Create a new command instance.
	 *
	 * @param Config $config
	 * @return void
	 */
	public function __construct($plugin, Config $config)
	{
		parent::__construct();

		$this->plugin = $plugin;
		$this->assetsPath = $config->get("laravel-grunt::assets_path");
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		// If either Node or Npm are missing, exit application
		if (! $this->hasNpm())
		{
			$this->error('It appears that Npm is not installed.  Please install and try again!');
			exit();
		}

		$this->getDefaultPlugins();

		$this->info('Created Gruntfile');
	}

	/**
	 * Does user have Npm installed?
	 *
	 * @return boolean
	 */
	protected function hasNpm()
	{
		return shell_exec('npm -v');
	}

	/**
	 * Install default plugins
	 *
	 * @return void
	 */
	protected function getDefaultPlugins()
	{
		$this->info('Ensuring that you have all required plugins...');

		$requiredPlugins = array(
			'grunt-cli', 'grunt-contrib-watch',
			'grunt-phpunit', 'grunt-contrib-concat',
			'grunt-contrib-cssmin', 'grunt-contrib-uglify'
		);

		foreach($requiredPlugins as $plugin)
		{
			$this->getPlugin($plugin);
		}
	}

	protected function getPlugin($pluginName)
	{
		if (! $this->plugin->exists($pluginName))
		{
			$this->info("installing $pluginName...");
			$this->plugin->install($pluginName);
			$this->info("The {$pluginName} plugin hs been installed.");
		}
	}
}