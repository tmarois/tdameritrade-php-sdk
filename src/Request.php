<?php namespace TD;

use GuzzleHttp\Client;
use TD\TDAmeritrade;

class Request
{
    /**
     * TD Class
     *
     * @return TD
     */
    private $td;

    /**
     * Guzzle Client
     *
     * @return GuzzleHttp\Client
     */
    private $client;

    /**
     * Start the class()
     *
     */
    public function __construct(TDAmeritrade $td, $timeout = 4)
    {
        $this->td = $td;

        $this->client = new Client([
            'timeout'  => $timeout
        ]);
    }

    /**
     * send()
     *
     * Send request
     *
     * @return Alpaca\Response
     */
    public function send($handle, $query = [], $params = [], $type = 'GET')
    {
        $uri = $this->prepareUrl($handle, $params);
        
        $headers = [];
        if ($handle != 'auth') {
            $headers = [
                'authorization' => 'Bearer '.$this->td->auth()->getAccessToken()
            ];

            if ($handle == 'orders') {
                $headers['Content-Type'] =  'application/json';
            }
        }

        $seconds = 0;

        $fn = [
            'headers' => $headers,
            'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$seconds) {
                $seconds = $stats->getTransferTime(); 
             }
        ];

        if ($params && $handle != 'orders') {
            $fn['form_params'] = $params;
        }

        if ($query) 
        {
            if ($handle == 'orders') {
                $fn['body'] = json_encode($query,1);
            }
            else {
                $fn['query'] = $query;
            }
        }

        $request = $this->client->request($type, $this->td->getRoot().$uri, $fn);

        // send and return the request response
        return (new Response($request, $seconds));
    }

    /**
     * prepareUrl()
     *
     * Get and prepare the url
     *
     * @return string
     */
    private function prepareUrl($handle, $segments = [])
    {
        $url = $this->td->getPath($handle);

        foreach($segments as $segment=>$value) {
            $url = str_replace('{'.$segment.'}', $value, $url);
        }

        return $url;
    }
}
