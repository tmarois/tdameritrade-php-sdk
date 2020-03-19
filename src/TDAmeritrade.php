<?php namespace TD;

use TD\Request;
use TD\Auth\Authentication;

use TD\Account\Accounts;
use TD\Account\Orders;
use TD\Account\Positions;
use TD\Stream\WebSocket;

class TDAmeritrade
{

    /**
     * auth
     *
     * @var TD\Auth\Authentication
     */
    private $auth;

    /**
     * Orders
     *
     * @var TD\Account\Orders
     */
    private $orders;

    /**
     * Accounts
     *
     * @var TD\Account\Accounts
     */
    private $accounts;

    /**
     * Positions
     *
     * @var TD\Account\Positions
     */
    private $positions;

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
        'auth'           => '/v1/oauth2/token',
        'userprincipals' => '/v1/userprincipals',
        'account'        => '/v1/accounts/{accountId}',
        'accounts'       => '/v1/accounts',
        'order'          => '/v1/accounts/{accountId}/orders/{orderId}',
        'orders'         => '/v1/accounts/{accountId}/orders'
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
    public function getRoot() {
        return $this->apiPath;
    }

    /**
     * getPath()
     *
     * @return string
     */
    public function getPath($handle) {
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
     * orders()
     *
     * @return TD\Account\Orders
     */
    public function orders($accountId) 
    {
        if ($this->orders) {
            return $this->orders;
        }

        return ($this->orders = (new Orders($this, $accountId)));
    }

    /**
     * accounts()
     *
     * @return TD\Account\Accounts
     */
    public function accounts()
    {
        if ($this->accounts) {
            return $this->accounts;
        }

        return ($this->accounts = (new Accounts($this)));
    }

    /**
     * positions()
     *
     * @return TD\Account\Positions
     */
    public function positions($accountId)
    {
        if ($this->positions) {
            return $this->positions;
        }

        return ($this->positions = (new Positions($this, $accountId)));
    }

    /**
     * auth()
     *
     * @return TD\Auth\Authentication
     */
    public function stream()
    {
        if ($this->websocket) {
            return $this->websocket;
        }

        return ($this->websocket = (new WebSocket($this)));
    }

    /**
     * request()
     *
     * @return TD\Request
     */
    public function request($handle, $query = [], $params = [], $type = 'GET', $url = null) {
        return (new Request($this))->send($handle, $query, $params, $type, $url);
    }

}
