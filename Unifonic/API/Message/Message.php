<?php


namespace Unifonic\API\Message;

use Unifonic\API\Exception;
use Unifonic\lib\GUMP\GUMP;

/**
 * Class Message
 * @package Unifonic\API\Message
 */
Class Message
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
            'Send' => [
                'Recipient' => 'numeric|required|min_len,12|max_len,14',
                'Body' => 'required',
                'SenderID' => 'max_len,16',
            ],
            'SendBulkMessages' => [
                'Recipient' => 'required',
                'Body' => 'required',
                'SenderID' => 'max_len,16',
            ],
            'GetMessageIDStatus' => [
                'MessageID' => 'numeric|required',
            ],
            'GetMessagesDetails' => [
                'MessageID' => 'numeric',
                'status' => 'min_len,12|max_len,14',
                'SenderID' => 'max_len,16',
                'DateFrom' => 'max_len,55',
                'DateFTo' => 'max_len,55',
                'limit' => 'numeric',
                'page' => 'numeric',
            ],
            'GetMessagesReport' => [
                'DateFrom' => 'max_len,55',
                'DateFTo' => 'max_len,55',
            ],
            'GetScheduled' => [],
            'StopScheduled' => [
                'Recipient' => 'numeric|required|'
            ]
        ];

        return $rules["$methodName"];

    }

    /**
     * @param $Recipient
     * @param $Body
     * @param $SenderID
     *
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function Send($Recipient, $Body, $SenderID = null)
    {
        try {

            $aParams = [
                'Recipient' => $Recipient,
                'Body' => $Body,
                'SenderID' => $SenderID
            ];

            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_Send($aParams);
            } else {
                return $valid[0];
            }


        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $Recipient
     * @param $Body
     * @param $SenderID
     *
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function SendBulkMessages($Recipient, $Body, $SenderID = null)
    {
        try {
            $aParams = [
                'Recipient' => $Recipient,
                'Body' => $Body,
                'SenderID' => $SenderID
            ];

            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_SendBulk($aParams);
            } else {
                return $valid[0];
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $MessageID
     *
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function GetMessageIDStatus($MessageID)
    {
        try {

            $aParams = ['MessageID' => $MessageID];

            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetMessageIDStatus($aParams);
            } else {
                return $valid[0];
            }


        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * @param $MessageID
     * @param $status
     * @param $SenderID
     * @param $DateFrom
     * @param $DateTo
     * @param $limit
     * @param $page
     *
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function GetMessagesDetails(
        $MessageID = null,
        $status = null,
        $SenderID = null,
        $DateFrom = null,
        $DateTo = null,
        $limit = null,
        $page = null
    ) {

        try {
            $aParams = [
                'MessageID' => $MessageID,
                'status' => $status,
                'SenderID' => $SenderID,
                'DateFrom' => $DateFrom,
                'DateTo' => $DateTo,
                'Limit' => $limit,
                'page' => $page
            ];

            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetMessagesDetails($aParams);
            } else {
                return $valid[0];
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $DateFrom
     * @param $DateTo
     *
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function GetMessagesReport($DateFrom = null, $DateTo = null)
    {
        try {
            $aParams = ['DateFrom' => $DateFrom, 'DateTo' => $DateTo];

            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetMessagesReport($aParams);
            } else {
                return $valid[0];
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function GetScheduled()
    {
        try {
            $aParams = [];

            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetScheduled($aParams);
            } else {
                return $valid[0];
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     * @throws \Unifonic\API\Exception
     */
    public function StopScheduled($MessageID)
    {
        try {
            $aParams = ['MessageID' => $MessageID];

            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_StopScheduled($aParams);
            } else {
                return $valid[0];
            }

        } catch (Exception $e) {
            throw $e;
        }
    }
}