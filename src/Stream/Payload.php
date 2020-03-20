<?php namespace TD\Stream;

use TD\Stream\Services\AcctActivity;
use TD\Stream\Services\Admin;
use TD\Stream\Services\Raw;

class Payload
{
    /**
     * data
     *
     * @var array
     */
    private $data;

    /**
     * services
     *
     * @var array
     */
    private $allowedServices = [
        'ACCT_ACTIVITY',
        'ADMIN',
        'ACTIVES_NASDAQ',
        'ACTIVES_NYSE',
        'ACTIVES_OTCBB',
        'ACTIVES_OPTIONS'
    ];

    /**
     * content
     *
     * @var array
     */
    private $content = [];

    /**
     * service
     *
     * @var mixed
     */
    private $service = null;

    /**
     *  __construct 
     *
     */
    public function __construct($data) 
    {
        $this->data = $data;

        $payload = $this->returnData();

        if (isset($payload['service'])) {
            $this->serviceName = $payload['service'];
        }

        if (isset($payload['content'])) 
        {
            $this->content = $payload['content'];

            if (isset($payload['content'][0])) {
                $this->content = $payload['content'][0];
            }
        }

        // switch($this->serviceName)
        // {
        //     case 'ACCT_ACTIVITY' :
        //         $this->service = (new AcctActivity())->setData($data);
        //     break;

        //     case 'ADMIN' :
        //         $this->service = (new Admin())->setData($data);
        //     break;

        //     default : 
        //         $this->service = (new Raw())->setData($data);
        // }

    }

    /**
     *  returnData 
     *
     */
    private function returnData() 
    {
        // everything else
        // https://developer.tdameritrade.com/content/streaming-data#_Toc504640580
        if (isset($this->data['data'])) 
        {
            if (isset($this->data['data'])) {
                return $this->data['data'][0] ?? [];
            }

            return $this->data['data'] ?? [];
        }

        // response (LOGIN/LOGOUT)
        if (isset($this->data['response'])) {
            return $this->data['response'][0] ?? [];
        }

        // chart history
        if (isset($this->data['snapshot'])) {
            return $this->data['snapshot'][0] ?? [];
        }

        // heartbeat
        if (isset($this->data['notify'])) {
            return $this->data['notify'][0] ?? [];
        }
    }

    /**
     *  data 
     *
     */
    public function data() {
        return $this->data;
    }

    /**
     *  content 
     *
     */
    public function content() {
        return $this->content;
    }

    /**
     *  service 
     *
     */
    public function service() {
        return $this->service;
    }
}