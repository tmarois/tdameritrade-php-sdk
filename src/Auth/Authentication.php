<?php namespace TD\Auth;

use TD\TDAmeritrade;

/**
 * Authentication
 *
 * @see https://developer.tdameritrade.com/authentication/apis/post/token-0
 * 
 */
class Authentication
{
    /**
     * TD
     * 
     * @return TDAmeritrade
     */
    private $td;

    /**
     * clientId
     *
     * @var string
     */
    private $clientId;

    /**
     * accessToken
     *
     * @var string
     */
    private $accessToken;

    /**
     * requestURI
     *
     * @var string
     */
    private $requestURI;

     /**
     * API Auth Path
     *
     * @var array
     */
    private $authPath = 'https://auth.tdameritrade.com/auth?response_type=code&redirect_uri={REQUEST_URL}&client_id={CLIENTID}%40AMER.OAUTHAP';

    /**
     * Set Alpaca 
     *
     */
    public function __construct(TDAmeritrade $td)
    {
        $this->td = $td;
    }

    /**
     * setClientId()
     *
     * @return string
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * getClientId()
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * setRefreshToken()
     *
     * @return string
     */
    public function setAccessToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * getRefreshToken()
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->refreshToken;
    }

    /**
     * setRequestURI()
     *
     * @return string
     */
    public function setRequestURI($requestUri)
    {
        $this->requestURI = $requestUri;
        return $this;
    }

    /**
     * getRequestURI()
     *
     * @return string
     */
    public function getRequestURI()
    {
        return $this->requestURI;
    }

    /**
     * getPath()
     *
     * @return string
     */
    public function getPath()
    {
        return $this->authPath;
    }

    /**
     * getLoginPath()
     *
     * @return string
     */
    public function getLoginPath()
    {
        $path = $this->getPath();
        $path = str_replace('{REQUEST_URL}', rawurlencode($this->getRequestURI()), $path);
        $path = str_replace('{CLIENTID}', $this->getClientId(), $path);

        return $path;
    }

    /**
     * requestRefreshToken()
     *
     * @return string
     */
    public function requestAccessToken($code)
    {
        return $this->td->request('auth',[
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $this->getClientId(),
            'redirect_uri' => $this->getRequestURI()
        ],'POST')->contents();
    }

}
