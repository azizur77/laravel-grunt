<?php namespace Codenexus\LaravelGrunt;

class Module {

	/**
	 * Install plugin if it doesn't exist
	 *
	 * @param string $moduleName
	 * @return void
	 */
	public function mustBeAvailable($moduleName)
	{
		if (! $this->exists($moduleName))
		{
			$this->install($moduleName);
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