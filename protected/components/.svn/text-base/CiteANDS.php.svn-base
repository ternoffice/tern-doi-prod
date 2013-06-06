<?php
/* Class name: Cite ANDS
 * Description: This class takes care of all communication with ANDS API
 */

class CiteANDS
{

    var $resultXML;
	
    /**
    * To make web service call to ANDS service point with XML in post variable.
    * Contruct ANDS service point URI
    * @param text $docUrl the document URL, text $docXml the DOI information in XML format, text $action 'update' or 'mint' action, text $doi the DOI for update
    * @return array $doi the response from ANDS service point 
    */
    public function postANDS($docUrl, $docXml, $action, $doi="")
    {
        //get URL from action
        $url = $this->getURL($action);
        //get App ID
        $appId = $this->getAppId();

        // set up the xml post field to contain the valid Datacite schema xml
        $xml = 'xml=' . $docXml;
        $xml = html_entity_decode($xml);

        // define the call to the service
        $requestURI = $url . "?app_id=" . $appId . "&url=" . $docUrl;

        // an update request
        if ($doi != "" && $action == 'update')
        {
            $requestURI.='&doi=' . $doi;
        }

        //use curl to connect and run  the service and receive the response $newch
        $newch = curl_init();
        curl_setopt($newch, CURLOPT_URL, $requestURI);
        curl_setopt($newch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($newch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($newch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($newch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($newch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($newch);
//print_r($xml);print_r($result);die();

        $resultXML = "";
        if ($result)
        {
            $resultXML = $result;
        }

        //print_r(curl_error($newch));
        $doi = $this->verifyResult($resultXML, $newch, $requestURI);
        curl_close($newch);
        return $doi;
    }

    /**
    * To make web service call to ANDS service poin.
    * Contruct ANDS service point URI
    * @param text $doi the DOI for update, text $action 'metadata', 'activate' or 'deactivate' action
    * @return array $doi the response from ANDS service point 
    */
    public function getANDS($doi, $action)
    {
        //get URL from action
        $url = $this->getURL($action);
        //get App ID
        $appId = $this->getAppId();

        // define the call to the service
        $requestURI = $url . "?app_id=" . $appId . "&doi=" . $doi;

        //use curl to connect and run  the service and receive the response $newch
        $newch = curl_init();
        curl_setopt($newch, CURLOPT_URL, $requestURI);
        curl_setopt($newch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($newch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($newch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($newch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($newch);
//print_r($xml);print_r($result);die();

        $resultXML = "";
        if ($result)
        {
            $resultXML = $result;
        }

        $doi = $this->verifyResult($resultXML, $newch, $requestURI);
        curl_close($newch);
        return $doi;
    }

    /**
    * To verify the response ANDS.
    * @param text $resultXML the response from ANDS, CURL object $ch, and text $doc_url the ANDS service point URI
    * @return array of 'doi' the DOI being processed, 'Status' the CURL HTTP response, 'xml' the ANDS xml response  
    */
    protected function verifyResult($resultXML, $ch, $doc_url)
    {
        $curlInfo = curl_getinfo($ch);
        // Check HTTP status, and
        // Contruct log and error message if ANDS service point call is unsuccess
        if (empty($resultXML) || curl_error($ch) != "" || $curlInfo['http_code'] != "200")
        {
            Yii::log('Error sending to ANDS: ' . $doc_url . ' [' . $curlInfo['http_code'] . '][' . $resultXML . ']', 'error', 'system.components.CiteANDS');
            if (strpos($resultXML, 'is not set to inactive so cannot') !== false || strpos($resultXML, 'is not set to active so cannot') !== false)
            {
                $doiPos = (int) strpos($resultXML, 'DOI') + 4;
                $doiEnd = ((int) strpos($resultXML, ' ', $doiPos));
                $doi = substr($resultXML, $doiPos, (int) ($doiEnd - $doiPos ));
                return array('doi' => $doi, 'Status' => $curlInfo, 'xml' => $resultXML);
            }
            else
            {
                return array('doi' => false, 'Status' => $curlInfo, 'xml' => $resultXML);
            }
        }
        elseif (strpos($resultXML, 'does not exist') !== false || 
		  strpos($resultXML, 'No metadata exists') !== false ||
		  strpos($resultXML, 'Disallowed Key Characters.') !== false)
        {
            Yii::log('Error sending to ANDS: ' . $doc_url . ' [' . $curlInfo['http_code'] . '][' . $resultXML . ']', 'error', 'system.components.CiteANDS');
            return array('doi' => false, 'Status' => $curlInfo, 'xml' => $resultXML);
        }
        else
        {
            $doiPos = (int) strpos($resultXML, 'DOI') + 4;
            $doiEnd = ((int) strpos($resultXML, ' ', $doiPos));
            $doi = substr($resultXML, $doiPos, (int) ($doiEnd - $doiPos ));
            return array('doi' => $doi, 'Status' => $curlInfo, 'xml' => $resultXML);
        }

        return array('doi' => false, 'Status' => $curlInfo, 'xml' => $resultXML);
    }

    /**
    * To extract ANDS service point by corresponding action.
    * @param text $action the action
    * @return text of the ANDS service point from Yii::app()->params
    */
    public static function getURL($action)
    {
        switch ($action)
        {
            case 'mint':
                return Yii::app()->params->andsMintUrl;
                break;
            case 'update':
                return Yii::app()->params->andsUpdateUrl;
                break;
            case 'deactivate':
                return Yii::app()->params->andsDeactivateUrl;
                break;
            case 'activate':
                return Yii::app()->params->andsActivateUrl;
                break;
            case 'metadata':
                return Yii::app()->params->andsMetadataUrl;
                break;
        }
        return false;
    }

    /**
    * To retrive the registered ANDS AppID.
    * @return text of the the AppID Yii::app()->params
    */
    public static function getAppId()
    {

        return Yii::app()->params->appId;
    }

}
?>
