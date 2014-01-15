<?php namespace Codenexus\LaravelGrunt;

use Illuminate\Config\Repository as Config;

class Gruntfile {

	/**
	 * Filesystem Instance
	 *
	 * @var Illuminate\Filesystem\Filesystem
	 */
	protected $file;

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
		$this->file = $file;
		$this->config = $config;
		$this->path = $path ?: base_path();
	}

	public function getPath()
	{
		return $this->path.'/Gruntfile.js';
	}
}