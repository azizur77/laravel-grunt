<?php

class PackageTest extends PHPUnit_Framework_TestCase {

	protected function tearDown() {
		Mockery::close();
	}

	public function testCanInstallModuleIfNotExists()
	{
		$module = Mockery::mock('Codenexus\LaravelGrunt\Module[exists, install]');

		// Let's assume that the module is not installed on a user's system
		$module->shouldReceive('exists')->once()->andReturn(false);

		// Then the install method should be called
		$module->shouldReceive('install')->once();

		$module->mustBeAvailable('foo');
	}

	public function testDoesNothingIfModuleExists()
	{
		$module = Mockery::mock('Codenexus\LaravelGrunt\Module[exists, install]');

		// Let's assume that the module is installed on a user's system
		$module->shouldReceive('exists')->once()->andReturn(true);

		// Then the install method should never be called
		$module->shouldReceive('install')->never();

		$module->mustBeAvailable('foo');
	}

}