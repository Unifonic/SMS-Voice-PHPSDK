<?php

namespace OTS\API\Voice;
use OTS\lib\GUMP\GUMP;

/**
 * Class Voice
 * @package OTS\API\Voice
 */
    Class Voice {

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
     * @return $rules["$methodName"]
     */
        public function Rules($methodName){

    	    $rules = array('GetCallIDStatus'=>array('CallID'=>'numeric|required') ,
                           'Call' =>array('Recipient'=>'numeric|required|min_len,12|max_len,12','Content'=>'required'),
                           'TTSCall' =>array('Recipient'=>'required|min_len,12|max_len,12|numeric','Content'=>'required','Language'=>'required'),
                           'GetCallsDetails' =>array('CallID'=>'required|numeric','DateTo'=>'required','DateFrom'=>'required'));
		    return $rules["$methodName"];
        }

    /**
     * @param $CallID
     * @return mixed
     */
        public function GetCallIDStatus($CallID){


        	$aParams = array('CallID'=>$CallID);
            $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
			if($valid===TRUE)
                return $this->client->Voice_GetCallIDStatus($aParams);
            else
                return $valid[0];

        }

    /**
     * @param $Recipient
     * @param $Content
     * @return mixed
     */
       public function Call($Recipient , $Content){
        	$aParams = array('Recipient'=>$Recipient,'Content'=>$Content);
            $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
            if($valid===TRUE)
                return $this->client->Voice_call($aParams);
            else
                return $valid[0];

        }
    /**
     * @param $Recipient
     * @param $Content
     * @param $Language
     * @return mixed
     */
        public function TTSCall($Recipient,$Content,$Language){

        	$aParams = array('Recipient'=>$Recipient,'Content'=>$Content,'Language'=>$Language);
            $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
            if($valid===TRUE)
                return $this->client->Voice_TTSCall($aParams);
            else
                return $valid[0];

        }


    /**
     * @param $CallID
     * @param $DateFrom
     * @param $DateTo
     * @return mixed
     */
        public function GetCallsDetails($CallID,$DateFrom,$DateTo){

        	$aParams = array('CallID'=>$CallID,'DateFrom'=>$DateFrom,'DateTo'=>$DateTo);
            $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
            if($valid===TRUE)
                return $this->client->Voice_GetCallsDetails($aParams);
            else
                return $valid[0];
        }


}

