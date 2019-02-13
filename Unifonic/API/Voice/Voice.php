<?php

namespace Unifonic\API\Voice;

use Unifonic\lib\GUMP\GUMP;

/**
 * Class Voice
 * @package Unifonic\API\Voice
 */
Class Voice
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
            'GetCallIDStatus' => ['CallID' => 'numeric|required'],
            'Call' => ['Recipient' => 'numeric|required|min_len,12|max_len,12', 'Content' => 'required'],
            'TTSCall' => [
                'Recipient' => 'required|min_len,12|max_len,12|numeric',
                'Content' => 'required',
                'Language' => 'required'
            ],
            'GetCallsDetails' => ['CallID' => 'required|numeric', 'DateTo' => 'required', 'DateFrom' => 'required'],
            'GetScheduled' => [],
            'StopScheduled' => [
                'CallID' => 'required|numeric'
            ]
        ];

        return $rules["$methodName"];
    }

    /**
     * @param $CallID
     *
     * @return mixed
     */
    public function GetCallIDStatus($CallID)
    {
        $aParams = ['CallID' => $CallID];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Voice_GetCallIDStatus($aParams);
        } else {
            return $valid[0];
        }
    }

    /**
     * @param $Recipient
     * @param $Content
     *
     * @return mixed
     */
    public function Call($Recipient, $Content)
    {
        $aParams = ['Recipient' => $Recipient, 'Content' => $Content];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Voice_call($aParams);
        } else {
            return $valid[0];
        }
    }

    /**
     * @param $Recipient
     * @param $Content
     * @param $Language
     *
     * @return mixed
     */
    public function TTSCall($Recipient, $Content, $Language)
    {
        $aParams = ['Recipient' => $Recipient, 'Content' => $Content, 'Language' => $Language];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Voice_TTSCall($aParams);
        } else {
            return $valid[0];
        }
    }


    /**
     * @param $CallID
     * @param $DateFrom
     * @param $DateTo
     *
     * @return mixed
     */
    public function GetCallsDetails($CallID, $DateFrom, $DateTo)
    {
        $aParams = ['CallID' => $CallID, 'DateFrom' => $DateFrom, 'DateTo' => $DateTo];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Voice_GetCallsDetails($aParams);
        } else {
            return $valid[0];
        }
    }

    /**
     * @return mixed
     */
    public function GetScheduled()
    {
        $aParams = [];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Voice_GetScheduledg();
        } else {
            return $valid[0];
        }
    }

    /**
     * @param $CallID
     *
     * @return mixed
     */
    public function StopScheduled($CallID)
    {
        $aParams = ['CallID' => $CallID];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Voice_StopScheduled($aParams);
        } else {
            return $valid[0];
        }
    }
}