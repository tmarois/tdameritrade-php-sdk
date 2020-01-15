<?php namespace TD\Account;

use TD\TDAmeritrade;

class Positions
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
     * getAll()
     *
     * @return array
     */
    public function getAll() 
    {
        $accountDetails = $this->td->accounts()->get($this->accountId, ['fields'=>'positions'],'GET')->results()['response'] ?? [];
        return $accountDetails['securitiesAccount']['positions'] ?? [];
    }

    /**
     * get()
     *
     * @return array
     */
    public function get($stock) 
    {
        $positions = $this->getAll();

        foreach($positions as $pos) 
        {
            $symbol = $pos['instrument']['symbol'] ?? '';
            if (strtolower($symbol) == strtolower($stock)) {
                return $pos;
            }
        }

        return [];
    }

}
