<?php

class PackageTest extends PHPUnit_Framework_TestCase {

	protected function tearDown() {
		Mockery::close();
	}

	public function testCanInstallPackageIfNotExists()
	{
		$package = Mockery::mock('Codenexus\LaravelGrunt\Package[exists, install]');

		// Let's assume that the plugin is not installed on a user's system
		$package->shouldReceive('exists')->once()->andReturn(false);

		// Then the install method should be called
		$package->shouldReceive('install')->once();

		$package->mustBeAvailable('foo');
	}

	public function testDoesNothingIfPackageExists()
	{
		$package = Mockery::mock('Codenexus\LaravelGrunt\Package[exists, install]');

		// Let's assume that the plugin is installed on a user's system
		$package->shouldReceive('exists')->once()->andReturn(true);

		// Then the install method should never be called
		$package->shouldReceive('install')->never();

		$package->mustBeAvailable('foo');
	}

}