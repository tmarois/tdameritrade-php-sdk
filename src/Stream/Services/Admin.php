<?php namespace TD\Stream\Services;

use TD\Stream\ServiceInterface;

class Admin implements ServiceInterface
{
    /**
     * data
     *
     * @var array
     */
    private $data;

    /**
     * messageTypes
     *
     * @var array
     */
    private $messageTypes = [
        'LOGIN',
        'LOGOUT',
        'QOS'
    ];

    /**
     *  __construct 
     *
     */
    public function __construct() {

    }

    /**
     *  setData 
     *
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     *  response 
     *
     */
    public function response() {
        return $this->data;
    }

}