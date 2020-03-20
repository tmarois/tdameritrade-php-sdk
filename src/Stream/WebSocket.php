<?php namespace TD\Stream;

use Carbon\Carbon;
use TD\TDAmeritrade;

use Amp\Websocket AS AmpSocket;
use Amp\Loop AS AmpLoop;
use Amp\Websocket\ClosedException;

class WebSocket
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
     * run()
     *
     */
    public function run($fn, $error) 
    {
        $data = $this->getPrincipals();
        $credentials = $this->setCredentials($data);

        AmpLoop::run(function () use ($fn, $error, $data, $credentials)
            {
                try 
                {
                    $connection = yield AmpSocket\connect('wss://'.$data['streamerInfo']['streamerSocketUrl'].'/ws');

                    yield $connection->send('
                    {
                        "requests":[
                            {
                                "service" : "ADMIN",
                                "command" : "LOGIN", 
                                "requestid" : "0",
                                "account" : "'.$credentials['userid'].'",
                                "source" : "'.$credentials['appid'].'",
                                "parameters" : {
                                    "credential" : "'.rawurlencode(http_build_query($credentials)).'",
                                    "token" : "'.$credentials['token'].'",
                                    "version" : "1.0"
                                 }
                            }
                        ]
                    }');

                    yield $connection->send('
                    {
                        "requests":[
                            {
                                "service" : "ADMIN",
                                "command" : "QOS", 
                                "requestid" : "1",
                                "account" : "'.$credentials['userid'].'",
                                "source" : "'.$credentials['appid'].'",
                                "parameters" : {
                                    "qoslevel": "0"
                                }
                            }
                        ]
                    }'); 

                    yield $connection->send('
                    {
                        "requests":[
                            {
                                "service" : "ACCT_ACTIVITY",
                                "command" : "SUBS", 
                                "requestid" : "2",
                                "account" : "'.$credentials['userid'].'",
                                "source" : "'.$credentials['appid'].'",
                                "parameters" : {
                                    "keys": "'.$data['streamerSubscriptionKeys']['keys'][0]['key'].'", 
                                    "fields": "0,1,2,3"
                                }
                            }
                        ]
                    }'); 
                                        
                    $i = 0;

                    while ($message = yield $connection->receive()) 
                    {
                        $i++;
                        $payload = yield $message->buffer();

                        $r = $fn(json_decode($payload,1),$i);

                        if ($r == false) {
                            $connection->close();
                            break;
                        }
                    }
                }
                catch (ClosedException $e) {
                    return $error('CLOSED',$e);
                }
                catch (\Throwable $e) {
                    return $error('ERROR',$e);
                }
                catch (\Exception $e) {
                    return $error('ERROR',$e);
                }
            }
        );
    }

    /**
     * setCredentials()
     *
     */
    public function setCredentials($data) 
    {
        $timestamp = $this->convertTimeStamp($data['streamerInfo']['tokenTimestamp']);

        return [
            'userid' => $data['accounts'][0]['accountId'],
            'token' => $data['streamerInfo']['token'],
            'company' => $data['accounts'][0]['company'],
            'segment' => $data['accounts'][0]['segment'],
            'cddomain' => $data['accounts'][0]['accountCdDomainId'],
            'usergroup' => $data['streamerInfo']['userGroup'],
            'accesslevel' => $data['streamerInfo']['accessLevel'],
            'authorized' => 'Y',
            'timestamp' => $timestamp,
            'appid' => $data['streamerInfo']['appId'],
            'acl' => $data['streamerInfo']['acl']
        ];
    }

    /**
     * convertTimeStamp()
     *
     */
    public function convertTimeStamp($timestamp) {
        return ((Carbon::parse($timestamp)->valueOf()));
    }

    /**
     * getPrincipals()
     *
     */
    public function getPrincipals() 
    {
        return $this->td->accounts()->userPrincipals([
            'fields' => 'streamerSubscriptionKeys,streamerConnectionInfo,preferences,surrogateIds'
        ]); 
    }
}
