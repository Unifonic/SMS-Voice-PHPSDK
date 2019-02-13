<?php

namespace Unifonic\API\Verify;

use Unifonic\lib\GUMP\GUMP;

/**
 * Class Voice
 * @package Unifonic\API\Verify
 */
Class Verify
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

    /**
     * @param $methodName
     *
     * @return mixed $rules["$methodName"]
     */
    public function Rules($methodName)
    {
        $rules = [
            'GetCode' => ['Recipient' => 'numeric|required|min_len,12|max_len,12', 'Body' => 'required'],
            'VerifyNumber' => [
                'Recipient' => 'numeric|required|min_len,12|max_len,12',
                'PassCode' => 'required|numeric|min_len,4|max_len,4'
            ]
        ];

        return $rules["$methodName"];
    }

    /**
     * @param $Recipient
     * @param $Body
     * @param $SecurityType
     * @param $Expiry
     *
     * @return mixed
     */

    public function GetCode($Recipient, $Body, $SecurityType = 'TSP', $Expiry = '24:00:00')
    {
        /*
         * $SecurityType Param can be either "Time Session PassCode : TSP - Default or One Time PassCode OTP "
         */
        $aParams = ['Recipient' => $Recipient, 'Body' => $Body, 'SecurityType' => $SecurityType, 'Expiry' => $Expiry];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Verify_GetCode($aParams);
        } else {
            return $valid[0];
        }
    }

    /**
     * @param $Recipient
     * @param $PassCode
     *
     * @return mixed
     */

    public function VerifyNumber($Recipient, $PassCode)
    {
        $aParams = ['Recipient' => $Recipient, 'PassCode' => $PassCode];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Verify_VerifyNumber($aParams);
        } else {
            return $valid[0];
        }
    }

}