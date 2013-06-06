<?php

/* This file is function library, it is included in config/main.php */

/**
* Email request to administartor 
* @param object $model the object of the request
*/
function mailAdmin($model)
{
	$server = substr($_SERVER["HTTP_REFERER"],0,strpos($_SERVER["HTTP_REFERER"],'index.php'));

       // Document URL model 
	if (isset($model->url))
	{
		$subject = 'DOI url register';
		$message = 'URL '.$model->url." is waiting for ANDS registration.\r\n".
			$server . 'index.php?r=docUrl/update&id='.$model->url;
	}
       // User model 
	else
	{
		$subject = 'DOI user approval';
		$message = 'User '.$model->username." is waiting for your approval.\r\n".
			$server . 'index.php?r=user/update&id='.$model->email;
	}

	$to      = Yii::app()->params->adminId;
	$headers = 'From: '.$model->email."\r\n" .
		'Reply-To: '.$model->email."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
}

/**
* Email confirmation to User 
* @param object $model the object of the request
*/
function mailUser($model)
{
	$server = substr($_SERVER["HTTP_REFERER"],0,strpos($_SERVER["HTTP_REFERER"],'index.php'));

       // Document URL model 
	if (isset($model->url))
	{
		$subject = 'DOI url register';
		$message = 'URL '.$model->url.' has been '.strtolower($model->approved)." by TERN DOI administrator.\r\n".
			$server . 'index.php?r=docUrl/';
	}
       // User model 
	else
	{
		$subject = 'DOI user approval';
		$message = 'User '.$model->username." has been approved by TERN DOI administrator.\r\n".
			$server . 'index.php?r=user/view&id='.$model->email;
	}

	$to      = $model->email;
	$headers = 'From: '.Yii::app()->params->adminId."\r\n" .
		'Reply-To: '.Yii::app()->params->adminId."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
}

/**
* Split multiple level array in to a string
* @param array $array, $glue
* @return text $ret the string of the imploded array
*/
function multiImplode($array, $glue)
{
    $ret = '';
    if (!is_array($array))
        return '<span class="null">Not set</span>';
    foreach ($array as $item)
    {
        if (is_array($item))
        {
            $ret .= multiImplode($item, $glue) . $glue;
        }
        else
        {
            $ret .= $item . $glue;
        }
    }
    $ret = substr($ret, 0, 0 - strlen($glue));
    return $ret;
}

/**
* insert a space before a Capital letter 
* @param string &$str the string for alternation 
* @return the alternated string
*/
function spaceCapital(&$str)
{
    return preg_replace('/(?<!\ )[A-Z]/', ' $0', $str);
}

/**
* Split creator array in to a string
* @param arrsy $creator
* @return text $strCreator the string of the imploded creators
*/
function implodeCreator($creator)
{
    $strValue = Yii::app()->params->strValue;
    $strCreator = '';
    $oneCreator;

    for ($i = 0; $i < count($creator); $i++)
    {
        $ncreator = $creator[$i];
        if (is_array($ncreator))
        {
            foreach ($ncreator as $key => $oneCreator)
            {
                if ($key == 'creatorName')
                {
                    $strCreator.= $oneCreator[$strValue];
                }
                else
                {
                    if (is_array($oneCreator))
                    {
                        $strCreator.=' (' . multiImplode($oneCreator, '-') . ')';
                    }
                }
            }
        }
        $strCreator .= '<br/> ';
    }
    return $strCreator;
}

/**
* Split document title array in to string
* @param arrsy $title
* @return text $strTitles the string of the imploded document titles
*/
function implodeTitles($titles)
{
    $strValue = Yii::app()->params->strValue;
    $strTitles = '';
    $oneTitle;
    for ($i = 0; $i < count($titles); $i++)
    {
        $ntitle = $titles[$i];
        if (is_array($ntitle))
        {
            foreach ($ntitle as $key => $oneTitle)
            {
                if ($key == $strValue)
                {
                    $strTitles .= $oneTitle;
                }
                else
                {
                    if (is_array($oneTitle))
                    {
                        $strTitles.=' (' . multiImplode($oneTitle, '-') . ')';
                    }
                }
            }
        }
        $strTitles .= '<br/> ';
    }
    return $strTitles;
}

/**
* Split document subject array in to string
* @param arrsy $subjects
* @return text $strSubjects the string of the imploded document subjects
*/
function implodeSubject($subjects)
{
    $strValue = Yii::app()->params->strValue;
    if (!is_array($subjects))
        return '<span class="null">Not set</span>';
    $strSubjects = '';
    $oneSubject;
    for ($i = 0; $i < count($subjects); $i++)
    {
        $nSubject = $subjects[$i];
        if (is_array($nSubject))
        {
            foreach ($nSubject as $key => $oneSubject)
            {
                if ($key == $strValue)
                {
                    $strSubjects .= $oneSubject;
                }
                else
                {
                    if (is_array($oneSubject))
                    {
                        $strSubjects .=' (' . multiImplode($oneSubject, ',') . ')';
                    }
                }
            }
        }
        $strSubjects .= '<br/> ';
    }
    return $strSubjects;
}

/**
* Split contributors array in to string
* @param arrsy $contributors
* @return text $strContributors the string of the imploded document contributors
*/
function implodeContributor($contributors)
{
    if (!is_array($contributors))
        return '<span class="null">Not set</span>';
    $strValue = Yii::app()->params->strValue;
    $strAttribute = Yii::app()->params->strAttribute;
    $strContributors = '';
    $oneContributor;

    for ($i = 0; $i < count($contributors); $i++)
    {
        $nContributor = $contributors[$i];
        if (is_array($nContributor))
        {
            foreach ($nContributor as $key => $oneContributor)
            {
                if ($key == 'contributorName')
                {
                    $strContributors .= $oneContributor[$strValue] . "  ";
                }
                elseif ($key == $strAttribute)
                {
                    $strContributors .= ' as  ' . preg_replace('/(\w+)([A-Z])/U', '\\1 \\2', $oneContributor['contributorType']);
                }
                else
                {
                    if ($key == 'nameIdentifier' && is_array($oneContributor))
                    {
                        $strContributors .=' (' . multiImplode($oneContributor, ',') . ')';
                    }
                }
            }
        }
        $strContributors .= '<br/> ';
    }
    return $strContributors;
}

/**
* Return ANDS reponse in meaningful text
* @param text $status the status of calling ANDS service point
* @return meaningful text
*/
function prepStatus($status)
{
    switch ($status)
    {
        case 'sent':
            return 'Successfully sent to ANDS';
        default:
            return 'Failed sending to ANDS';
    }
}

/**
* prepare string for DOI Citation
* @param array $data the array of document information
* @return doiCitateFormat with the data from the array $data 
*/
function dataCitate($data)
{
    $strValue = Yii::app()->params->strValue;
    $strCitate = '';
    $strCreatorSeparator = Yii::app()->params->doiCitateCreatorSeparator;
    $creator = array_map(
               function($n)
                    {
                        $strValue = Yii::app()->params->strValue;
                        return substr($n['creatorName'][$strValue],0,strpos($n['creatorName'][$strValue],',')+3);
                    }, $data['creator']);
    $creator = multiImplode($creator, $strCreatorSeparator);
    $title = $data['title'];
    $format = Yii::app()->params->doiCitateFormat;
    return sprintfn( $format, Array(
        'C' => $creator, 'D' => $data['identifier'], 'PY' => $data['publicationYear'], 'P' => $data['publisher'], 'T' => $title));
}

/**
* Flatten a multiple level array
* @param array $array the multiple level array, $key the keys of the lower level arrays
* @return $resultArray the flatten array 
*/
function flattenArray($array, $keys)
{

    $resultArray = Array();

    for ($i = 0; $i < count($array); $i++)
    {
        $stack = Array();
        foreach ($keys as $key)
        {
            $resultArray[$i][$key] = '';
        }
        array_push($stack, Array('key' => 'root', 'value' => $array[$i]));
        while (count($stack) > 0)
        {
            $node = array_pop($stack);

            if (is_array($node['value']))
            {

                foreach ($node['value'] as $key => $val)
                {
                    array_push($stack, Array('key' => $key, 'value' => $val));
                }
            }

            if (array_search($node['key'], $keys, TRUE) !== false)
            {

                if (is_array($node['value']))
                {
                    $resultArray[$i][$node['key']] = nl2br($node['value']['@value']);
                }
                else
                {
                    $resultArray[$i][$node['key']] = nl2br($node['value']);
                }
            }
        }
    }
    return $resultArray;
}

/**
* Format an array to a string
* @param array $array a the multiple level array, $key the keys of the lower level arrays
* @return $returnStr the stringified data   
*/
function formatArray2Sprintf($array, $format)
{
    $returnStr = '';
    for ($i = 0; $i < count($array); $i++)
    {
        $returnStr .= sprintfn($format, $array[$i]);
    }
    if ($returnStr == '')
        $returnStr = 'Not set';
    return $returnStr;
}

/**
 * This is a third-party function
 * version of sprintf for cases where named arguments are desired (php syntax)
 * with sprintf: sprintf('second: %2$s ; first: %1$s', '1st', '2nd');
 *
 * with sprintfn: sprintfn('second: %second$s ; first: %first$s', array(
 *  'first' => '1st',
 *  'second'=> '2nd'
 * ));
 *
 * @param string $format sprintf format string, with any number of named arguments
 * @param array $args array of [ 'arg_name' => 'arg value', ... ] replacements to be made
 * @return string|false result of sprintf call, or bool false on error
 */
function sprintfn($format, array $args = array())
{
    // map of argument names to their corresponding sprintf numeric argument value
    $arg_nums = array_slice(array_flip(array_keys(array(0 => 0) + $args)), 1);

    // find the next named argument. each search starts at the end of the previous replacement.
    for ($pos = 0; preg_match('/(?<=%)([a-zA-Z_]\w*)(?=\$)/', $format, $match, PREG_OFFSET_CAPTURE, $pos);)
    {
        $arg_pos = $match[0][1];
        $arg_len = strlen($match[0][0]);
        $arg_key = $match[1][0];

        // programmer did not supply a value for the named argument found in the format string
        if (!array_key_exists($arg_key, $arg_nums))
        {
            user_error("sprintfn(): Missing argument '${arg_key}'", E_USER_WARNING);
            return false;
        }

        // replace the named argument with the corresponding numeric one
        $format = substr_replace($format, $replace = $arg_nums[$arg_key], $arg_pos, $arg_len);
        $pos = $arg_pos + strlen($replace); // skip to end of replacement for next iteration
    }
    return vsprintf($format, array_values($args));
}
?>
