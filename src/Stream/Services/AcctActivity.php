<?php namespace TD\Stream\Services;

use TD\Stream\ServiceInterface;

class AcctActivity implements ServiceInterface
{

    /**
     * data
     *
     * @var array
     */
    protected $data;

    /**
     * messageTypes
     *
     * @var array
     */
    protected $messageTypes = [
        'SUBSCRIBED',
        'ERROR',
        'BrokenTrade',
        'ManualExecution',
        'OrderActivation',
        'OrderCancelReplaceRequest',
        'OrderCancelRequest',
        'OrderEntryRequest',
        'OrderFill',
        'OrderPartialFill',
        'OrderRejection',
        'TooLateToCancel',
        'UROUT'
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
    public function response() 
    {
        if (isset($this->data[2]))
        {
            $type    = $this->data[2];
            $content = simplexml_load_string($this->data[3] ?? '');

            $contentData = [];
            if (isset($content[$type.'Message'])) {
                $contentData = $content[$type.'Message'];
            }

            return [
                'type' => $type,
                'content' => $contentData
            ];
        }
        else 
        {
            return $this->data;
        }
    }

}