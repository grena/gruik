<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';


		return require __DIR__.'/../../bootstrap/start.php';
	}

        public static $preparedDatabase = false;

        public function setUp()
        {
            parent::setUp();
            if(self::$preparedDatabase == false)
            {
                self::$preparedDatabase = true;
            }
            Mail::pretend(true);
        }

}
