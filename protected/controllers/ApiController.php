<?php

class ApiController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * The web service API for POST action (Mint DOI or Update DOI).
	 * This method is the API which processes aubmitted POST variables for ANDS API.
	 * Construct post data into a DOC model array.
	 * Convert and construct DOC model into XML using DataCite2_2 and Array2XML.
	 * Call action processAPI to process data.
	 * Call action response to output HTTP code and XML response
	 */
	public function actionPost()
	{
		// Construct post data into a DOC model array.
		$postData = array();
		if (isset($_POST['doi']))
		{
			$postData['doc_doi'] = $_POST['doi'];
		}
		if (isset($_POST['title']))
		{
			for ($i=0;$i<count($_POST['title']);$i++) 
			{
				$postData['title'][$i]['@value'] = $_POST['title'][$i];
				if (isset($_POST['titleType'][$i]))
				{
					$postData['title'][$i]['@attributes']['titleType']= $_POST['titleType'][$i];
				}
			}
		}
		if (isset($_POST['doc_url'])){
			$postData['doc_url'] = $_POST['doc_url'];
		}
		if (isset($_POST['creatorName']))
		{
			for ($i=0;$i<count($_POST['creatorName']);$i++) 
			{
				$postData['creator'][$i]['creatorName']['@value'] = $_POST['creatorName'][$i];
				if (isset($_POST['nameIdentifier'][$i]))
				{
					$postData['creator'][$i]['nameIdentifier']['@value']= $_POST['nameIdentifier'][$i];
					$postData['creator'][$i]['nameIdentifier']['@attributes']['nameIdentifierScheme'] = $_POST['nameIdentifierScheme'][$i];
				}
			}
		}
		if (isset($_POST['publisher']))
		{
			$postData['publisher'] = $_POST['publisher'];
		}
		if (isset($_POST['publicationYear']))
		{
			$postData['publicationYear'] = $_POST['publicationYear'];
		}
		if (isset($_POST['subject'])){
			for ($i=0;$i<count($_POST['subject']);$i++) 
			{
				$postData['subject'][$i]['@value'] = $_POST['subject'][$i];
				if (isset($_POST['subjectScheme'][$i]))
				{
					$postData['subject'][$i]['@attributes']['subjectScheme']= $_POST['subjectScheme'][$i];
				}
			}
		}
		if (isset($_POST['contributorName'])){
			for ($i=0;$i<count($_POST['contributorName']);$i++) 
			{
				$postData['contributor'][$i]['contributorName']['@value'] = $_POST['contributorName'][$i];
				if (isset($_POST['contributorType'][$i]))
				{
					$postData['contributor'][$i]['@attributes']['contributorType']=$_POST['contributorType'][$i];
				}
				if (isset($_POST['nameIdentifier'][$i]))
				{
					$postData['contributor'][$i]['nameIdentifier']['@value'] = $_POST['nameIdentifier'][$i]; 
				}
				if (isset($_POST['nameIdentifierScheme'][$i]))
				{
					$postData['contributor'][$i]['nameIdentifier']['@attributes']['nameIdentifierScheme']=$_POST['nameIdentifierScheme'][$i]; 
				}
			}
		}
		if (isset($_POST['date'])){
			for ($i=0;$i<count($_POST['date']);$i++) 
			{
				$postData['date'][$i]['@value'] = $_POST['date'][$i];
				if (isset($_POST['dateType'][$i]))
				{
					$postData['date'][$i]['@attributes']['dateType']=$_POST['dateType'][$i];
				}
			}
		}
		if (isset($_POST['language']))
		{
			$postData['language'] = $_POST['language'];
		}
		if (isset($_POST['resourceType']))
		{
			$postData['resourceType']['@value'] = $_POST['resourceType'];
			if (isset($_POST['resourceTypeGeneral']))
			{
				$postData['resourceType']['@attributes']['resourceTypeGeneral']=$_POST['resourceTypeGeneral'];
			}
		}
		if (isset($_POST['alternateIdentifier'])){
			for ($i=0;$i<count($_POST['alternateIdentifier']);$i++) 
			{
				$postData['alternateIdentifier'][$i]['@value'] = $_POST['alternateIdentifier'][$i];
				if (isset($_POST['alternateIdentifierType'][$i]))
				{
					$postData['alternateIdentifier'][$i]['@attributes']['alternateIdentifierType']=$_POST['alternateIdentifierType'][$i];
				}
			}
		}
		if (isset($_POST['relatedIdentifier'])){
			for ($i=0;$i<count($_POST['relatedIdentifier']);$i++) 
			{
				$postData['relatedIdentifier'][$i]['@value'] = $_POST['relatedIdentifier'][$i];
				if (isset($_POST['relatedIdentifierType'][$i]))
				{
					$postData['relatedIdentifier'][$i]['@attributes']['relatedIdentifierType'] = $_POST['relatedIdentifierType'][$i];
				}
				if (isset($_POST['relationType'][$i]))
				{
					$postData['relatedIdentifier'][$i]['@attributes']['relationType'] = $_POST['relationType'][$i];
				}
			}
		}
		if (isset($_POST['size'])){
			for ($i=0;$i<count($_POST['size']);$i++) 
			{
				$postData['size'][$i]['@value'] = $_POST['size'][$i];
			}
		}
		if (isset($_POST['format'])){
			for ($i=0;$i<count($_POST['format']);$i++) 
			{
				$postData['format'][$i]['@value'] = $_POST['format'][$i];
			}
		}
		if (isset($_POST['version']))
		{
			$postData['version'] = $_POST['version'];
		}
		if (isset($_POST['rights']))
		{
			$postData['rights'] = $_POST['rights'];
		}
		if (isset($_POST['description']))
		{
			for ($i=0;$i<count($_POST['description']);$i++) 
			{
				$postData['description'][$i]['@value'] = $_POST['description'][$i];
				if (isset($_POST['descriptionType'][$i]))
				{
					$postData['description'][$i]['@attributes']['descriptionType']=$_POST['descriptionType'][$i];
				}
			}
		}

		// Convert and construct DOC model into XML using DataCite2_2 and Array2XML.
		$model = new Doc;
		$model->setAttributes($postData);
		$doc = DataCite2_2::constructDataArray($model);
		$_POST['xml'] = Array2XML::createXML('resource', $doc)->saveXML();
		// Format get variables required by ANDS API
		$user_id = isset($_POST['user_id'])? $_POST['user_id']:'';
		$app_id = isset($_POST['app_id'])? $_POST['app_id']:'';
		$url = isset($_POST['url'])? $_POST['url']:'';
		$doi = isset($_POST['doi'])? $_POST['doi']:null;
		$action = ($doi)? 'update':'mint'; 
		
		// Call action processAPI to process data.
		$result = $this->processAPI($user_id, $app_id, $doi, $action, $url);
		// Call action response to output HTTP code and XML response
		$this->response($result);
	}
        
	
	/**
	 * The web service API for Create action (Mint DOI).
	 * Call action processAPI to process data.
	 * Call action response to output HTTP code and XML response
	 * @param text $user_id the User login ID, $app_id the 32 characters App ID, and $url the landing page
	 */
	public function actionCreate($user_id, $app_id, $url)
	{
		$result = $this->processAPI($user_id, $app_id, null, 'mint', $url);
		$this->response($result);
	}
        
	/**
	 * The web service API for Create action (Update DOI).
	 * Call action processAPI to process data.
	 * Call action response to output HTTP code and XML response
	 * @param text $user_id the User login ID, $app_id the 32 characters App ID, $doi the DOI, and $url the landing page
	 */
	public function actionUpdate($user_id, $app_id, $doi, $url)
	{
		$result = $this->processAPI($user_id, $app_id, $doi, 'update', $url);
		$this->response($result);
	}
        
	/**
	 * The web service API for Inactive action (Deactivate DOI).
	 * Call action processAPI to process data.
	 * Call action response to output HTTP code and XML response
	 * @param text $user_id the User login ID, $app_id the 32 characters App ID, and $doi the DOI
	 */
	public function actionInactive($user_id, $app_id, $doi)
	{
		$result = $this->processAPI($user_id, $app_id, $doi, 'deactivate', null);
		$this->response($result);
	}
        
	/**
	 * The web service API for Active action (Activate DOI).
	 * Call action processAPI to process data.
	 * Call action response to output HTTP code and XML response
	 * @param text $user_id the User login ID, $app_id the 32 characters App ID, and $doi the DOI
	 */
	public function actionActive($user_id, $app_id, $doi)
	{
		$result = $this->processAPI($user_id, $app_id, $doi, 'activate', null);
		$this->response($result);
	}

	/**
	 * The private function to process data by call ANDS API.
	 * Validate the Data Manager ID , App ID, and XML format.
	 * Call ANDS API to process data.
	 * Update result into local datagase.
	 * @param text $user_id the User login ID, $app_id the 32 character App ID, $doi the DOI, $action the API action, and $url the landing page
	 * @return HTTP code and XML.
	 */
	private function processAPI($user_id, $app_id, $doi, $action, $url)
	{
		//Validate the Data Manager ID.
		$user=User::model()->findByPk($user_id);
		if (!isset($user->email))
		{
			$result = array('Status'=>array('http_code'=>500), 'xml'=>'[TERN-DOI] There has been an unexpected error processing your doi request. For more information please contact TERN DOI team. You must be a valid data manager.');
			return $result;
		} 
		elseif (!$user->enabled || !$user->approved)
		{
			$result = array('Status'=>array('http_code'=>500), 'xml'=>'[TERN-DOI] There has been an unexpected error processing your doi request. For more information please contact TERN DOI team. Your account is locked.');
			return $result;
		}
		//Validate the App ID.
		$appIdExpiry = Yii::app()->params->appIdExpiry;
              $digest = date('Y') . $user->email . $user->appid_seed . floor((date('m')-1)/$appIdExpiry);
		$dataMgr = (hash('ripemd128',$digest)==trim($app_id))? true:false;
		
		//Valid DOI ownership 
		if ($doi)
		{
			$ownDoi = Doc::model()->findByAttributes(array('doc_doi'=>$doi, 'user_id'=>$user_id));
			if (!$ownDoi){
				$result = array('Status'=>array('http_code'=>500), 'xml'=>'[TERN-DOI] There has been an unexpected error processing your doi request. For more information please contact TERN DOI team. You must be the DOI owner.');
				return $result;
			}
		}

		if (!$dataMgr) 
		{
			$result = array('Status'=>array('http_code'=>500), 'xml'=>'[TERN-DOI] There has been an unexpected error processing your doi request. For more information please contact TERN DOI team. You must provide a data manager app id to update a doi.');
		} 
		else 
		{
			$cite = new CiteANDS();

			// Call ANDS API to process data.
			if ($action=='update' || $action=='mint')
			{
				$xml = (isset($_POST['xml']))? $_POST['xml'] : '';
				$xml = $this->fixHtmlEntities($xml);
				$result = $cite->postANDS($url, $xml, $action, $doi);
			} 
			else 
			{
				$result = $cite->getANDS($doi, $action);
			}
			// Update result into local datagase.
			if ($result['doi'] != '')
			{
				switch($action){
					case 'activate': 
						Doc::model()->updateAll(array('doc_active'=>true),"doc_doi='$doi'");
						break;
					case 'deactivate':
						Doc::model()->updateAll(array('doc_active'=>false),"doc_doi='$doi'");
						break;
					case 'update':
						$metadata = $cite->getANDS($doi, 'metadata');
						$xml = $metadata['xml'];
						$xmlObj = @new SimpleXMLElement($xml);
						$doc_title = isset($xmlObj->titles->title)? $xmlObj->titles->title:'';
						Doc::model()->updateAll(array('doc_title'=>$doc_title, 'doc_xml'=>$xml, 'doc_status'=>'Successfully minted'),"doc_doi='$doi'");

						// ANDS has bug when DOI in submitted XML different to the DOI supplied on service point
						// DOI as in XML is actually updated 
						// Extract DOI from verbosemessage of the ANDS response for updating the local database   
						$resultXml = @new SimpleXMLElement($result['xml']);
						$doi = substr($resultXml->verbosemessage, strpos($resultXml->verbosemessage,'(')+1);
						$doi = str_replace(')','',$doi); 
						$metadata = $cite->getANDS($doi, 'metadata');
						$xml = $metadata['xml'];
						$xmlObj = @new SimpleXMLElement($xml);
						$doc_title = isset($xmlObj->titles->title)? $xmlObj->titles->title:'';
						Doc::model()->updateAll(array('doc_title'=>$doc_title, 'doc_xml'=>$xml, 'doc_status'=>'Successfully minted'),"doc_doi='$doi'");

						break;
					case 'mint':
						$metadata = $cite->getANDS($doi, 'metadata');
						$xmlObj = @new SimpleXMLElement($xml);
						$model = new Doc;
						$model->doc_url = $url;
						$model->doc_xml = 'API'; 
						$model->doc_doi = $result['doi'];
						$model->user_id = $user_id;
						$model->doc_active = true;
						$model->insert();
						$model->doc_xml = $metadata['xml']; 
						$model->doc_status = 'Successfully minted';
						$model->doc_title = isset($xmlObj->titles->title)? $xmlObj->titles->title:'';
						$model->saveAttributes(array('doc_status','doc_title','doc_xml'));
						break;
				}
			}
		}
		return $result;
	}
	
	/**
	 * The private function to fix Html entities.
	 * @param string $xml the result returned from ANDS API.
	 * @return fixed value.
	 */
	private function fixHtmlEntities($xml){
		// Encode html entities but destroy character nember referrence
		$xml = htmlentities($xml,ENT_NOQUOTES, 'ISO-8859-1');
		// Restore damaged character nember referrence
		while (strpos($xml,'&amp;'))
		{
			$xml = str_replace('&amp;', '&', $xml);
		}
		// Decode character nember referrence
		$xml = html_entity_decode($xml, ENT_COMPAT, 'UTF-8');
		return $xml;
	}

	/**
	 * The private function to output HTTP code and XML response.
	 * Set HTTP code header and output XML.
	 * @param array $result the result returned from ANDS API.
	 */
	private function response($result){
		header('HTTP/1.0 '.$result['Status']['http_code']);
		print_r($result['xml']);
	}
	
}
