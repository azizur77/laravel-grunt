<?php namespace Codenexus\LaravelGrunt;

use Illuminate\Config\Repository as Config;

class Gruntfile {

	/**
	 * Config Instance
	 *
	 * @var Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * Base path to where Gruntfile is stored
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * Constructor
	 *
	 * @param string $path
	 * @return void
	 */
	public function __construct(Config $config, $path = null)
	{
		$this->config = $config;
		$this->path = $path ?: base_path();
	}
}