<?php namespace TD;

use TD\Auth\Authentication;
use TD\Request;

class TDAmeritrade
{

    /**
     * auth
     *
     * @var TD\Auth\Authentication
     */
    private $auth;

    /**
     * API Path
     *
     * @var array
     */
    private $apiPath  = 'https://api.tdameritrade.com';

    /**
     * API Paths
     *
     * @var array
     */
    private $paths = [
        'auth'         => '/v1/oauth2/token',
        'account'      => '/v1/account/{ACCOUNTID}',
        'accounts'     => '/v1/accounts',
        'order'        => '/v1/accounts/{ACCOUNTID}/orders/{ORDERID}',
        'orders'       => '/v1/accounts/{ACCOUNTID}/orders'
    ];

    /**
     * Set Alpaca 
     *
     */
    public function __construct() {
        
    }

    /**
     * getPath()
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->apiPath;
    }

    /**
     * getPath()
     *
     * @return string
     */
    public function getPath($handle)
    {
        return $this->paths[$handle] ?? false;
    }

    /**
     * auth()
     *
     * @return TD\Auth\Authentication
     */
    public function auth()
    {
        if ($this->auth) {
            return $this->auth;
        }

        return ($this->auth = (new Authentication($this)));
    }

    /**
     * request()
     *
     * @return TD\Request
     */
    public function request($handle, $params = [], $type = 'GET', $url = null)
    {
        return (new Request($this))->send($handle, $params, $type, $url);
    }

}
