<?php namespace TD\Account;

use TD\TDAmeritrade;

class Accounts
{

    /**
     * TDAmeritrade
     *
     * @var TD\TDAmeritrade
     */
    private $td;

    /**
     *  __construct 
     *
     */
    public function __construct(TDAmeritrade $td) {
        $this->td = $td;
    }

    /**
     * get()
     *
     * @return array
     */
    public function get($id, $options = []) {
        return $this->td->request('account',$options,['accountId'=>$id],'GET')->response();
    }

    /**
     * getAll()
     *
     * @return array
     */
    public function getAll() {
        return $this->td->request('accounts',[],[],'GET')->response();
    }

}
