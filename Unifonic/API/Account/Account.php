<?php

namespace Unifonic\API\Account;

use Unifonic\API\Exception;
use Unifonic\lib\GUMP\GUMP;

/**
 * Class Account
 * @package Unifonic\API\Account
 */
Class Account
{

    /**
     * @var
     */
    private $client;

    /**
     * @param $oClient
     */
    public function __construct($oClient)
    {
        $this->client = $oClient;
    }


    public function Rules($methodName)
    {

        $rules = [
            'GetBalance' => [
            ],
            'AddSenderID' => [
                'SenderID' => 'required',
            ],
            'GetSenderIDStatus' => [
                'SenderID' => 'required',
            ],
            'GetSenderIDs' => [],
            'GetAppDefaultSenderID' => [
            ],
            'ChangeAppDefaultSenderID' => [],
            'DeleteSenderID' => [
                'SenderID' => 'required',
            ]
        ];

        return $rules["$methodName"];
    }


    /**
     * @return mixed
     */
    public function GetBalance()
    {
        $aParams = [];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Account_GetBalance();
        } else {
            return $valid[0];
        }
    }


    /**
     * @param $SenderID
     *
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function AddSenderID($SenderID)
    {
        try {
            $aParams = ['SenderID' => $SenderID];
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Account_AddSenderID($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param String $SenderID
     *
     * @return stdClass
     */
    public function GetSenderIDStatus($SenderID)
    {
        $aParams = ['SenderID' => $SenderID];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Account_GetSenderIDStatus($aParams);
        } else {
            return $valid[0];
        }
    }

    /**
     * @return stdClass
     */
    public function GetSenderIDs()
    {
        $aParams = [];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Account_GetSenderIDs($aParams);
        } else {
            return $valid[0];
        }
    }

    /**
     * @return stdClass
     */
    public function GetAppDefaultSenderID()
    {
        $aParams = [];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Account_GetAppDefaultSenderID();
        } else {
            return $valid[0];
        }
    }

    /**
     * @param String $SenderID
     *
     * @return stdClass
     */
    public function ChangeAppDefaultSenderID($SenderID)
    {
        $aParams = ['SenderID' => $SenderID];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->ChangeAppDefaultSenderID($aParams);
        } else {
            return $valid[0];
        }

    }

    /**
     * @param String $SenderID
     *
     * @return stdClass
     */
    public function DeleteSenderID($SenderID)
    {
        $aParams = ['SenderID' => $SenderID];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->DeleteSenderID($aParams);
        } else {
            return $valid[0];
        }
    }

}