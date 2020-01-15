<?php namespace Tests;

use TD\TDAmeritrade;

class AccountTest extends Config
{

   /**
     * TEST
     * testAccountsDetails
     *
     */
    public function testAccountsDetails()
    {
        $td = new TDAmeritrade();

        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $accounts = $td->accounts()->getAll();

        $this->assertTrue(is_array($accounts), true);

        $this->assertTrue(is_numeric($accounts['response'][0]['securitiesAccount']['accountId'] ?? false), true);
    }

    /**
     * TEST
     * testAccountsDetails
     *
     */
    public function testSpecificAccount()
    {
        $td = new TDAmeritrade();

        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $account = $td->accounts()->get($this->config['ACCOUNTID']);

        $this->assertTrue(is_array($account), true);

        $this->assertTrue(is_numeric($account['response']['securitiesAccount']['accountId'] ?? false), true);
    }
}