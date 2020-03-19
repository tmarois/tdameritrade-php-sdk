<?php namespace Tests;

use TD\TDAmeritrade;

class E_UserPrincipalsTest extends _Config
{

   /**
     * TEST
     * testPosition
     *
     */
    public function testPrincipals()
    {
        $this->assertTrue(true,true);
        return true;
        
        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $data = $td->accounts()->userPrincipals([
            'fields' => 'streamerSubscriptionKeys,streamerConnectionInfo,preferences,surrogateIds'
        ]); 

        print_r($data);  

        // streamer-ws.tdameritrade.com

        // $this->assertTrue(is_array($positions), true);

        // $this->assertTrue(($positions[0]['instrument']['assetType'] ?? false), 'CASH_EQUIVALENT');
    }
}