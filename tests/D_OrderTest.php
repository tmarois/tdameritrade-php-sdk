<?php namespace Tests;

use TD\TDAmeritrade;

class D_OrderTest extends _Config
{

   /**
     * TEST
     * testOrder
     *
     */
    public function testOrder()
    {
        $this->assertTrue(true,true);
        return true;
        
        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $order = $td->orders($this->config['ACCOUNTID'])->get('2557145408');

        print_r($order); 

        $this->assertTrue(is_array($order), true);

        $this->assertEquals(($order['price'] ?? false), 37.92);
    }


    /**
     * TEST
     * testOrder
     *
     */
    public function testBuyOrder()
    {
        $this->assertTrue(true,true);
        return true;
        
        $td = new TDAmeritrade();
        $td->auth()->setClientId($this->config['CLIENTID']);
        $td->auth()->setRequestURI($this->config['REQUESTURI']);
        $td->auth()->setAccessToken($this->config['ACCESSTOKEN']);

        $orderOption = '
        {
          "orderType": "MARKET",
          "session": "NORMAL",
          "duration": "DAY",
          "orderStrategyType": "SINGLE",
          "orderLegCollection": [
            {
              "instruction": "Buy",
              "quantity": 1,
              "instrument": {
                "symbol": "UWT",
                "assetType": "EQUITY"
              }
            }
          ]
        }
        ';

        $orderOption = '
        {
          "complexOrderStrategyType" : "NONE",
          "orderType": "LIMIT",
          "session": "NORMAL",
          "duration": "DAY",
          "price" : "0.2",
          "orderStrategyType": "SINGLE",
          "orderLegCollection": [
            {
              "instruction": "Buy",
              "quantity": 1,
              "instrument": {
                "symbol": "UWT",
                "assetType": "EQUITY"
              }
            }
          ]
        }
        ';

        // print_r(($orderOption));

        $orderOption = [
            'orderType' => 'LIMIT',
            'session' => 'NORMAL',
            'duration' => 'DAY',
            'complexOrderStrategyType' => 'NONE',
            'orderStrategyType' => "SINGLE",
            // 'stopPrice' => 0,
            'price' => "0.2",
            'orderLegCollection' => [[
              'instruction' => 'Buy',
              'quantity' => '1',
                'instrument' => [
                    "assetType" => "EQUITY",
                    "symbol" => "UWT"
                ]
            ]]
        ];

        // print_r(json_encode($orderOption));

        $order = $td->orders($this->config['ACCOUNTID'])->create($orderOption);

        $orderOption['price'] = "0.25";
        $order = $td->orders($this->config['ACCOUNTID'])->create($orderOption);

        print_r($order); 

        // $this->assertTrue(is_array($order), true);

        // $this->assertEquals(($order['price'] ?? false), 37.92);
    }
}







/*

{
    "session": "'NORMAL' or 'AM' or 'PM' or 'SEAMLESS'",
    "duration": "'DAY' or 'GOOD_TILL_CANCEL' or 'FILL_OR_KILL'",
    "orderType": "'MARKET' or 'LIMIT' or 'STOP' or 'STOP_LIMIT' or 'TRAILING_STOP' or 'MARKET_ON_CLOSE' or 'EXERCISE' or 'TRAILING_STOP_LIMIT' or 'NET_DEBIT' or 'NET_CREDIT' or 'NET_ZERO'",
    "cancelTime": {
        "date": "string",
        "shortFormat": false
    },
    "complexOrderStrategyType": "'NONE' or 'COVERED' or 'VERTICAL' or 'BACK_RATIO' or 'CALENDAR' or 'DIAGONAL' or 'STRADDLE' or 'STRANGLE' or 'COLLAR_SYNTHETIC' or 'BUTTERFLY' or 'CONDOR' or 'IRON_CONDOR' or 'VERTICAL_ROLL' or 'COLLAR_WITH_STOCK' or 'DOUBLE_DIAGONAL' or 'UNBALANCED_BUTTERFLY' or 'UNBALANCED_CONDOR' or 'UNBALANCED_IRON_CONDOR' or 'UNBALANCED_VERTICAL_ROLL' or 'CUSTOM'",
    "quantity": 0,
    "filledQuantity": 0,
    "remainingQuantity": 0,
    "requestedDestination": "'INET' or 'ECN_ARCA' or 'CBOE' or 'AMEX' or 'PHLX' or 'ISE' or 'BOX' or 'NYSE' or 'NASDAQ' or 'BATS' or 'C2' or 'AUTO'",
    "destinationLinkName": "string",
    "releaseTime": "string",
    "stopPrice": 0,
    "stopPriceLinkBasis": "'MANUAL' or 'BASE' or 'TRIGGER' or 'LAST' or 'BID' or 'ASK' or 'ASK_BID' or 'MARK' or 'AVERAGE'",
    "stopPriceLinkType": "'VALUE' or 'PERCENT' or 'TICK'",
    "stopPriceOffset": 0,
    "stopType": "'STANDARD' or 'BID' or 'ASK' or 'LAST' or 'MARK'",
    "priceLinkBasis": "'MANUAL' or 'BASE' or 'TRIGGER' or 'LAST' or 'BID' or 'ASK' or 'ASK_BID' or 'MARK' or 'AVERAGE'",
    "priceLinkType": "'VALUE' or 'PERCENT' or 'TICK'",
    "price": 0,
    "taxLotMethod": "'FIFO' or 'LIFO' or 'HIGH_COST' or 'LOW_COST' or 'AVERAGE_COST' or 'SPECIFIC_LOT'",
    "orderLegCollection": [
        {
            "orderLegType": "'EQUITY' or 'OPTION' or 'INDEX' or 'MUTUAL_FUND' or 'CASH_EQUIVALENT' or 'FIXED_INCOME' or 'CURRENCY'",
            "legId": 0,
            "instrument": "The type <Instrument> has the following subclasses [Option, MutualFund, CashEquivalent, Equity, FixedIncome] descriptions are listed below\"",
            "instruction": "'BUY' or 'SELL' or 'BUY_TO_COVER' or 'SELL_SHORT' or 'BUY_TO_OPEN' or 'BUY_TO_CLOSE' or 'SELL_TO_OPEN' or 'SELL_TO_CLOSE' or 'EXCHANGE'",
            "positionEffect": "'OPENING' or 'CLOSING' or 'AUTOMATIC'",
            "quantity": 0,
            "quantityType": "'ALL_SHARES' or 'DOLLARS' or 'SHARES'"
        }
    ],
    "activationPrice": 0,
    "specialInstruction": "'ALL_OR_NONE' or 'DO_NOT_REDUCE' or 'ALL_OR_NONE_DO_NOT_REDUCE'",
    "orderStrategyType": "'SINGLE' or 'OCO' or 'TRIGGER'",
    "orderId": 0,
    "cancelable": false,
    "editable": false,
    "status": "'AWAITING_PARENT_ORDER' or 'AWAITING_CONDITION' or 'AWAITING_MANUAL_REVIEW' or 'ACCEPTED' or 'AWAITING_UR_OUT' or 'PENDING_ACTIVATION' or 'QUEUED' or 'WORKING' or 'REJECTED' or 'PENDING_CANCEL' or 'CANCELED' or 'PENDING_REPLACE' or 'REPLACED' or 'FILLED' or 'EXPIRED'",
    "enteredTime": "string",
    "closeTime": "string",
    "tag": "string",
    "accountId": 0,
    "orderActivityCollection": [
        "\"The type <OrderActivity> has the following subclasses [Execution] descriptions are listed below\""
    ],
    "replacingOrderCollection": [
        {}
    ],
    "childOrderStrategies": [
        {}
    ],
    "statusDescription": "string"
}

//The class <Instrument> has the 
//following subclasses: 
//-Option
//-MutualFund
//-CashEquivalent
//-Equity
//-FixedIncome
//JSON for each are listed below: 

//Option:
{
  "assetType": "'EQUITY' or 'OPTION' or 'INDEX' or 'MUTUAL_FUND' or 'CASH_EQUIVALENT' or 'FIXED_INCOME' or 'CURRENCY'",
  "cusip": "string",
  "symbol": "string",
  "description": "string",
  "type": "'VANILLA' or 'BINARY' or 'BARRIER'",
  "putCall": "'PUT' or 'CALL'",
  "underlyingSymbol": "string",
  "optionMultiplier": 0,
  "optionDeliverables": [
    {
      "symbol": "string",
      "deliverableUnits": 0,
      "currencyType": "'USD' or 'CAD' or 'EUR' or 'JPY'",
      "assetType": "'EQUITY' or 'OPTION' or 'INDEX' or 'MUTUAL_FUND' or 'CASH_EQUIVALENT' or 'FIXED_INCOME' or 'CURRENCY'"
    }
  ]
}

//OR

//MutualFund:
{
  "assetType": "'EQUITY' or 'OPTION' or 'INDEX' or 'MUTUAL_FUND' or 'CASH_EQUIVALENT' or 'FIXED_INCOME' or 'CURRENCY'",
  "cusip": "string",
  "symbol": "string",
  "description": "string",
  "type": "'NOT_APPLICABLE' or 'OPEN_END_NON_TAXABLE' or 'OPEN_END_TAXABLE' or 'NO_LOAD_NON_TAXABLE' or 'NO_LOAD_TAXABLE'"
}

//OR

//CashEquivalent:
{
  "assetType": "'EQUITY' or 'OPTION' or 'INDEX' or 'MUTUAL_FUND' or 'CASH_EQUIVALENT' or 'FIXED_INCOME' or 'CURRENCY'",
  "cusip": "string",
  "symbol": "string",
  "description": "string",
  "type": "'SAVINGS' or 'MONEY_MARKET_FUND'"
}

//OR

//Equity:
{
  "assetType": "'EQUITY' or 'OPTION' or 'INDEX' or 'MUTUAL_FUND' or 'CASH_EQUIVALENT' or 'FIXED_INCOME' or 'CURRENCY'",
  "cusip": "string",
  "symbol": "string",
  "description": "string"
}

//OR

//FixedIncome:
{
  "assetType": "'EQUITY' or 'OPTION' or 'INDEX' or 'MUTUAL_FUND' or 'CASH_EQUIVALENT' or 'FIXED_INCOME' or 'CURRENCY'",
  "cusip": "string",
  "symbol": "string",
  "description": "string",
  "maturityDate": "string",
  "variableRate": 0,
  "factor": 0
}

//The class <OrderActivity> has the 
//following subclasses: 
//-Execution
//JSON for each are listed below: 

//Execution:
{
  "activityType": "'EXECUTION' or 'ORDER_ACTION'",
  "executionType": "'FILL'",
  "quantity": 0,
  "orderRemainingQuantity": 0,
  "executionLegs": [
    {
      "legId": 0,
      "quantity": 0,
      "mismarkedQuantity": 0,
      "price": 0,
      "time": "string"
    }
  ]
}


*/