<?php namespace Codenexus\LaravelGrunt;

class Package {

	/**
	 * Install plugin if it doesn't exist
	 *
	 * @param string $packageName
	 * @return void
	 */
	public function mustBeAvailable($packageName)
	{
		if (! $this->exists($packageName))
		{
			$this->install($packageName);
		}
	}

	/**
	 * Determines if plugin exists
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function exists($name)
	{
		return ! is_null(shell_exec("npm explore $name 2>/dev/null"));
	}

	/**
	 * Installs plugin
	 * @param string name
	 * @return void
	 */
	public function install($name)
	{
		shell_exec("npm install $name");
	}
}