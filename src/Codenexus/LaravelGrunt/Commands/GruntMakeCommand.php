<?php namespace Codenexus\LaravelGrunt\Commands;

use Illuminate\Console\Command;

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
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->info('Created Gruntfile');
	}
}