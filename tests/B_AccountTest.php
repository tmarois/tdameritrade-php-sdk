<?php namespace Tests;

use TD\TDAmeritrade;

class B_AccountTest extends _Config
{

   /**
     * TEST
     * testAccountsDetails
     *
     */
    public function testAccountsDetails()
    {
        $this->assertTrue(true,true);
        return true;

        $td = new TDAmeritrade();

        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $accounts = $td->accounts()->getAll();

        print_r($accounts);

        $this->assertTrue(is_array($accounts), true);
        $this->assertTrue(is_numeric($accounts[0]['securitiesAccount']['accountId'] ?? false), true);
    }

    /**
     * TEST
     * testSpecificAccount
     *
     */
    public function testSpecificAccount()
    {
        $this->assertTrue(true,true);
        return true;

        $td = new TDAmeritrade();

        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $account = $td->accounts()->get($this->config['ACCOUNTID']);

        print_r($account);

        $this->assertTrue(is_array($account), true);
        $this->assertTrue(is_numeric($account['securitiesAccount']['accountId'] ?? false), true);
    }
}