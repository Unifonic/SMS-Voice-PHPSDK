<?php

namespace OTS\API\Account;
use OTS\API\Exception;
use OTS\lib\GUMP\GUMP;

/**
 * Class Account
 * @package OTS\API\Account
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


    public function Rules($methodName){

        $rules = array(
            'GetBalance' => array(

            ),
            'AddSenderID' => array(
                'SenderID'  =>  'numeric|required',
            ),
            'GetSenderIDStatus' => array(
                'SenderID'  =>  'required',
            ),
            'GetSenderIDs' => array(),
            'GetAppDefaultSenderID' => array(
            ),
            'ChangeAppDefaultSenderID'=>array(),
            'DeleteSenderID'=>array(
                'SenderID'  =>  'required',
            )

        );

        return $rules["$methodName"];

    }




    /**
     * @return mixed
     */
    public function GetBalance()
    {
        $aParams = array();
        $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
        if($valid === true)
        {
        return $this->client->Account_GetBalance();

        }else{
            return $valid[0];
        }
    }


    /**
     * @param $SenderID
     * @return mixed
     * @throws \Exception
     * @throws \OTS\API\Exception
     */
    public function AddSenderID($SenderID)
    {
        try {
            $aParams = array('SenderID' => $SenderID);
            $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
            if($valid === true)
            {
            return $this->client->Account_AddSenderID($aParams);
            }else{
                return $valid[0];
            }
        } catch (Exception $e) {
           throw $e;

        }
    }

    /**
     * @param String$SenderID
     * @return stdClass
     */
    public function GetSenderIDStatus($SenderID){
        $aParams = array('SenderID' => $SenderID);
        $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
        if($valid === true)
        {
        return $this->client->Account_GetSenderIDStatus($aParams);
        }else{
            return $valid[0];
        }
    }

    /**
     * @return stdClass
     */
    public function GetSenderIDs(){
        $aParams = array();
        $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
        if($valid === true)
        {
        return $this->client->Account_GetSenderIDs($aParams);
        }else{
            return $valid[0];
        }
    }

    /**
     * @return stdClass
     */
    public function GetAppDefaultSenderID(){
        $aParams = array();
        $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
        if($valid === true)
        {
        return $this->client->Account_GetAppDefaultSenderID();
        }else{
            return $valid[0];
        }
    }

    /**
     * @param String $SenderID
     * @return stdClass
     */
    public function ChangeAppDefaultSenderID($SenderID){
        $aParams = array('SenderID' => $SenderID);
        $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
        if($valid === true)
        {
            return $this->client->ChangeAppDefaultSenderID($aParams);
        }else{
            return $valid[0];
        }

    }

    /**
     * @param String $SenderID
     * @return stdClass
     */
    public function DeleteSenderID($SenderID){
        $aParams = array('SenderID' => $SenderID);
        $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
        if($valid === true)
        {
        return $this->client->DeleteSenderID($aParams);
        }else{
            return $valid[0];
        }
    }


}