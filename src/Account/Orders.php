<?php namespace TD\Account;

use TD\TDAmeritrade;

class Orders
{

    /**
     * TDAmeritrade
     *
     * @var TD\TDAmeritrade
     */
    private $td;

    /**
     * Account Id
     *
     * @var TD\TDAmeritrade
     */
    private $accountId;

    /**
     *  __construct 
     *
     */
    public function __construct(TDAmeritrade $td, $accountId) 
    {
        $this->td = $td;

        $this->accountId = $accountId;
    }

    /**
     * get()
     *
     * @return array
     */
    public function get($id) {
        return $this->td->request('order',[],['accountId'=>$this->accountId,'orderId'=>$id],'GET')->response();
    }

    /**
     * create()
     *
     * @return array
     */
    public function create($options = []) {
        return $this->td->request('orders',$options,['accountId'=>$this->accountId],'POST')->response();
    }

    /**
     * replace()
     *
     * @return array
     */
    public function replace($id, $options = []) {
        return $this->td->request('order',$options,['accountId'=>$this->accountId],'PUT')->response();
    }

    /**
     * cancel()
     *
     * @return array
     */
    public function cancel($id) {
        return $this->td->request('order',$options,['accountId'=>$this->accountId],'DELETE')->response();
    }
}


