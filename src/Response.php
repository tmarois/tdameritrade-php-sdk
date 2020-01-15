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

        $this->seconds = $seconds;
    }

    /**
     * contents()
     *
     * get contents
     *
     */
    public function contents() {
        return json_decode($this->request->getBody()->getContents(),true);
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
            'response' => $this->contents(),
            'seconds' => $this->seconds()
        ];
    }
}
