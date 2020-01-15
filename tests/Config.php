<?php namespace Tests;

use Dotenv\Dotenv;

class Config extends \PHPUnit\Framework\TestCase
{
    /**
     * Config variable
     *
     * Everything here is from the ENV file
     */
    public $config = [];

   /**
     * Config
     *
     */
    public function __construct()
    {
        // locate the env files
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();

        // add the env conv variables 
        $this->config = getenv();

        // run the parent __construct
        parent::__construct();
    }
}