<?php namespace Tests;

use TD\TDAmeritrade;

class A_AuthTest extends _Config
{

   /**
     * TEST
     * testAuthPath
     *
     */
    public function testAuthPath()
    {
        $this->assertTrue(true,true);

        // $td = new TDAmeritrade();
        // $td->auth()->setClientId($this->config['CLIENTID']);
        // $td->auth()->setRequestURI($this->config['REQUESTURI']);

        // print_r("\n".$td->auth()->getLoginPath()."\n");

        // $this->assertTrue(is_string($td->auth()->getLoginPath()), " ");

        // $this->assertTrue(is_string($td->getPath('auth')), " ");
    }

    /**
     * TEST
     * testMakeRequest
     *
     */
    public function testMakeRequest()
    {
        $this->assertTrue(true,true);
        return false;

        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);

        print_r($td->auth()->requestAccessToken(rawurldecode($this->config['AUTHCODE'])));

        $this->assertTrue(true,true);
    }


    /**
     * TEST
     * testMakeRequest
     *
     */
    public function testMakeUpdate()
    {
        $this->assertTrue(true,true);
        return false;

        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);

        print_r($td->auth()->authRefresh($this->config['REFRESHTOKEN']));

        $this->assertTrue(true,true);
    }

}

/*
example response: 

    [access_token] => khj0og8Fm....
    [scope] => PlaceTrades AccountAccess MoveMoney
    [expires_in] => 1800
    [token_type] => Bearer
)
*/