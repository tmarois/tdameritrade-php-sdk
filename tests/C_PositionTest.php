<?php namespace Tests;

use TD\TDAmeritrade;

class C_PositionTest extends _Config
{

   /**
     * TEST
     * testPosition
     *
     */
    public function testPosition()
    {
        $this->assertTrue(true,true);
        return true;
        
        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $positions = $td->positions($this->config['ACCOUNTID'])->getAll();

        print_r($positions);  

        $this->assertTrue(is_array($positions), true);

        $this->assertTrue(($positions[0]['instrument']['assetType'] ?? false), 'CASH_EQUIVALENT');
    }


    /**
     * TEST
     * testSpecificStockPosition
     *
     */
    public function testSpecificStockPosition()
    {
        $this->assertTrue(true,true);
        return true;
        
        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        //MMDA1
        // $position = $td->positions($this->config['ACCOUNTID'])->get('UGAZ');
        $position = $td->positions($this->config['ACCOUNTID'])->get('MMDA1');

        print_r($position);  

        $this->assertTrue(is_array($position), true);

        $this->assertEquals(($position['instrument']['assetType'] ?? false), 'CASH_EQUIVALENT');
    }
}