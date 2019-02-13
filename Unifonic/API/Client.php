<?php

namespace Unifonic\API;

use Unifonic\API\Account\Account;
use Unifonic\API\Checker\Checker;
use Unifonic\API\Message\Message;
use Unifonic\API\Verify\Verify;
use Unifonic\API\Voice\Voice;

class Client
{
    /**
     * @var Message
     */
    public $Messages;

    /**
     * @var Voice
     */
    public $Voice;

    /**
     * @var Account
     */
    public $Account;

    /**
     * @var Account
     */
    public $Checker;
    /**
     * @var Verify
     */
    public $Verify;
    /**
     * @param string $apiKey
     * @param string $apiSecret
     */
    private $API_URL;
    private $sMethod;
    public $aParams;

    public function __construct()
    {
        $config = require(dirname(__FILE__) . '/../config.php');
        $this->API_URL = $config['ApiURL'];
        $this->APP_SID = $config['AppSid'];
        $this->Messages = new Message($this);
        $this->Account = new Account($this);
        $this->Voice = new Voice($this);
        $this->Verify = new Verify($this);
        $this->Checker = new Checker($this);
    }

    private function call()
    {
        $this->aParams['AppSid'] = $this->APP_SID;
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $this->API_URL . $this->sMethod);
        curl_setopt($ch, CURLOPT_POST, count($this->aParams));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->aParams));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);

        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //close connection
        curl_close($ch);
        if ($http_status == 500) {
            throw new Exception('Couldn\'t Connect to API');
        }

        $aResult = json_decode($result);

        if ($aResult && isset($aResult->success)) {
            if ($aResult->success == 'true') {
                return $aResult->data;
            }
            $code = str_replace('ER-', '', $aResult->errorCode);

            throw new Exception(serialize($aResult->message), $code);
        }
        //throw new Exception('Invalid Response');
    }

    /**
     * @param $methodname
     * @param $args
     *
     * @return mixed
     * @throws Exception
     */
    public function __call($methodname, $args)
    {
        if (method_exists($this, $methodname)) {
            return $this->$methodname();
        }
        $this->sMethod = str_replace('_', '/', $methodname);
        $this->aParams = isset($args[0]) ? $args[0] : null;

        return $this->call();
    }

}
