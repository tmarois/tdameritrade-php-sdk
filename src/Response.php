<?php namespace TD;

class Response
{
    /**
     * Guzzle Request
     *
     * @return GuzzleHttp\Psr7\Response
     */
    private $request;

    /**
     * Guzzle Request
     *
     * @return GuzzleHttp\Psr7\Response
     */
    private $body;

    /**
     * Speed of request in seconds
     *
     * @return float
     */
    private $seconds = 0;

    /**
     * Start the class()
     *
     */
    public function __construct(\GuzzleHttp\Psr7\Response $request, $seconds = 0)
    {
        $this->request = $request;

        $this->body    = json_decode($this->request->getBody()->getContents(),true);

        $this->seconds = $seconds;
    }

    /**
     * contents()
     *
     * get contents
     *
     */
    public function response() {
        return $this->body;
    }

    /**
     * seconds()
     *
     * get seconds for request
     *
     */
    public function seconds() {
        return $this->seconds;
    }

    /**
     * results()
     *
     * get the results and time of response
     *
     */
    public function results()
    {
        return [
            'response' => $this->response(),
            'seconds' => $this->seconds()
        ];
    }
}
