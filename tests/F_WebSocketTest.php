<?php namespace Tests;

use TD\TDAmeritrade;

class F_WebSocketTest extends _Config
{

   /**
     * TEST
     * testPosition
     *
     */
    public function testSocket()
    {
        $this->assertTrue(true,true);
        // return true;
        
        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $td->stream()->run(function($payload, $i) {

            // $data = json_decode($payload,1);

            $data = $payload;

            $status = $data['response'][0]['content']['code'] ?? false;

            if ($status===0)
            {
                print_r($data);
                return true;
            }
            else {
                print_r($data);
                # code...
            }
 
            return true;

        },function($status, $e){
            print_r($status);
        }); 

    }
}