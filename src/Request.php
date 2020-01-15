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
    public function send($handle, $params = [], $type = 'GET')
    {
        // build and prepare our full path rul
        $uri = $this->prepareUrl($handle, $params);

        // lets track how long it takes for this request
        $seconds = 0;

        // // push request
        $request = $this->client->request($type, $this->td->getRoot().$uri, [
            'form_params' => $params,
            'headers' => [

            ],
            'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$seconds) {
                $seconds = $stats->getTransferTime(); 
             }
        ]);

        // // send and return the request response
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
