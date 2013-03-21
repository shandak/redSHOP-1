<?php

/**
 * @copyright Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license   GNU/GPL, see license.txt or http://www.gnu.org/copyleft/gpl.html
 *            Developed by email@recomponent.com - redCOMPONENT.com
 *
 * redSHOP can be downloaded from www.redcomponent.com
 * redSHOP is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.
 *
 * You should have received a copy of the GNU General Public License
 * along with redSHOP; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin');
//$mainframe =& JFactory::getApplication();
//$mainframe->registerEvent( 'onPrePayment', 'plgRedshoprs_payment_bbs' );
class plgRedshop_paymentrs_payment_sagepay extends JPlugin
{
	var $_table_prefix = null;

	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for
	 * plugins because func_get_args ( void ) returns a copy of all passed arguments
	 * NOT references.  This causes problems with cross-referencing necessary for the
	 * observer design pattern.
	 */
	function plgRedshop_paymentrs_payment_sagepay(&$subject)
	{
		// load plugin parameters
		parent::__construct($subject);
		$this->_table_prefix = '#__redshop_';
		$this->_plugin = JPluginHelper::getPlugin('redshop_payment', 'rs_payment_sagepay');
		$this->_params = new JRegistry($this->_plugin->params);


	}

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 */
	function onPrePayment($element, $data)
	{

		if ($element != 'rs_payment_sagepay')
		{
			return;
		}
		if (empty($plugin))
		{
			$plugin = $element;
		}

		$mainframe =& JFactory::getApplication();
		$paymentpath = JPATH_SITE . DS . 'plugins' . DS . 'redshop_payment' . DS . $plugin . DS . $plugin . DS . 'extra_info.php';
		include($paymentpath);

	}

	function onNotifyPaymentrs_payment_sagepay($element, $request)
	{
		if ($element != 'rs_payment_sagepay')
		{
			return;
		}
		$strCrypt = $request["crypt"];
		if (strlen($strCrypt) == 0)
		{
			ob_end_flush();
		}
		// Now decode the Crypt field and extract the results
		$strDecoded = $this->simpleXor($this->Base64Decode($strCrypt), $this->_params->get("sagepay_encryptpass"));
		$responsevalues = $this->getToken($strDecoded);

		$debug_mode = $this->_params->get("debug_mode");
		$verify_status = $this->_params->get("verify_status");
		$invalid_status = $this->_params->get("invalid_status");

		// Split out the useful information into variables we can use
		$strStatus = $responsevalues['Status'];
		$strStatusDetail = $responsevalues['StatusDetail'];
		$strVendorTxCode = $responsevalues["VendorTxCode"];
		$strVPSTxId = str_replace("{", "", $responsevalues["VPSTxId"]);
		$strVPSTxId = str_replace("}", "", $strVPSTxId);
		$strTxAuthNo = $responsevalues["TxAuthNo"];
		$strAmount = $responsevalues["Amount"];
		$strAVSCV2 = $responsevalues["AVSCV2"];
		$strAddressResult = $responsevalues["AddressResult"];
		$strPostCodeResult = $responsevalues["PostCodeResult"];
		$strCV2Result = $responsevalues["CV2Result"];
		$strGiftAid = $responsevalues["GiftAid"];
		$str3DSecureStatus = $responsevalues["3DSecureStatus"];
		$strCAVV = $responsevalues["CAVV"];
		$strCardType = $responsevalues["CardType"];
		$strLast4Digits = $responsevalues["Last4Digits"];
		//$strAddressStatus=$responsevalues["AddressStatus"]; // PayPal transactions only
		//$strPayerStatus=$responsevalues["PayerStatus"];     // PayPal transactions only

		// Update the database and redirect the user appropriately
		if ($strStatus == "OK")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_AUTHORISED"); //"AUTHORISED - The transaction was successfully authorised with the bank.";
		elseif ($strStatus == "MALFORMED")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_MALFORMED") . mysql_real_escape_string(substr($strStatusDetail, 0, 255));
		//"MALFORMED - The StatusDetail was:" . mysql_real_escape_string(substr($strStatusDetail,0,255));
		elseif ($strStatus == "INVALID")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_INVALID") . mysql_real_escape_string(substr($strStatusDetail, 0, 255));
		//"INVALID - The StatusDetail was:" . mysql_real_escape_string(substr($strStatusDetail,0,255));
		elseif ($strStatus == "NOTAUTHED")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_DECLINED");
		//"DECLINED - The transaction was not authorised by the bank.";
		elseif ($strStatus == "REJECTED")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_REJECTED");
		//"REJECTED - The transaction was failed by your 3D-Secure or AVS/CV2 rule-bases.";
		elseif ($strStatus == "AUTHENTICATED")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_AUTHENTICATED");
		//"AUTHENTICATED - The transaction was successfully 3D-Secure Authenticated and can now be Authorised.";
		elseif ($strStatus == "REGISTERED")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_REGISTERED");
		//"REGISTERED - The transaction was could not be 3D-Secure Authenticated, but has been registered to be Authorised.";
		elseif ($strStatus == "ERROR")
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_ERROR") . mysql_real_escape_string($strStatusDetail);
		//"ERROR - There was an error during the payment process.  The error details are: " . mysql_real_escape_string($strStatusDetail);
		else
			$strDBStatus = JText::_("COM_REDSHOP_SAGEPAY_UNKNOWN") . mysql_real_escape_string($strStatus) . ", with StatusDetail:" . mysql_real_escape_string($strStatusDetail);
		//"UNKNOWN - An unknown status was returned from Sage Pay.  The Status was: " . mysql_real_escape_string($strStatus) . ", with StatusDetail:" . mysql_real_escape_string($strStatusDetail);

		// UPDATE THE ORDER STATUS to 'CONFIRMED'
		if (($strStatus == "OK") || ($strStatus == "AUTHENTICATED") || ($strStatus == "REGISTERED"))
		{

			if ($debug_mode == 1)
			{
				$payment_message = $strStatusDetail;
			}
			else
			{
				$payment_message = JText::_('COM_REDSHOP_ORDER_PLACED');
			}
			// SUCCESS: UPDATE THE ORDER STATUS to 'CONFIRMED'
			$values->order_status_code = $verify_status;
			$values->order_payment_status_code = 'Paid';
			$values->transaction_id = $strVPSTxId;
			$values->order_id = $request['orderid'];


		}
		else
		{

			if ($debug_mode == 1)
			{
				$payment_message = $strStatusDetail;
			}
			else
			{
				$payment_message = JText::_('COM_REDSHOP_ORDER_NOT_PLACED');
			}
			// FAILED: UPDATE THE ORDER STATUS to 'PENDING'
			$values->order_status_code = $invalid_status;
			$values->order_payment_status_code = 'Unpaid';
			$values->order_id = $request['orderid'];
		}

		$values->log = $payment_message;
		$values->msg = $payment_message;

		return $values;
	}

	function onCapture_Paymentrs_payment_sagepay($element, $data)
	{
		return;
	}

	function requestPost($url, $data)
	{

		ob_clean();
		ob_get_clean();
		// Set a one-minute timeout for this script
		set_time_limit(60);

		// Initialise output variable
		$output = array();

		// Open the cURL session
		$curlSession = curl_init();

		// Set the URL
		curl_setopt($curlSession, CURLOPT_URL, $url);
		// No headers, please
		curl_setopt($curlSession, CURLOPT_HEADER, 0);
		// It's a POST request
		curl_setopt($curlSession, CURLOPT_POST, 1);
		// Set the fields for the POST
		curl_setopt($curlSession, CURLOPT_POSTFIELDS, $data);
		// Return it direct, don't print it out
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
		// This connection will timeout in 30 seconds
		curl_setopt($curlSession, CURLOPT_TIMEOUT, 30);
		//The next two lines must be present for the kit to work with newer version of cURL
		//You should remove them if you have any problems in earlier versions of cURL
		curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 1);

		//Send the request and store the result in an array

		$rawresponse = curl_exec($curlSession);
		//Store the raw response for later as it's useful to see for integration and understanding
		$_SESSION["rawresponse"] = $rawresponse;
		//Split response into name=value pairs
		$response = preg_split(chr(10), $rawresponse);

		echo "<pre>";
		print_r($response);
		exit;
		// Check that a connection was made
		if (curl_error($curlSession))
		{
			// If it wasn't...
			$output['Status'] = "FAIL";
			$output['StatusDetail'] = curl_error($curlSession);
		}

		// Close the cURL session
		curl_close($curlSession);

		// Tokenise the response
		for ($i = 0; $i < count($response); $i++)
		{
			// Find position of first "=" character
			$splitAt = strpos($response[$i], "=");
			// Create an associative (hash) array with key/value pairs ('trim' strips excess whitespace)
			$output[trim(substr($response[$i], 0, $splitAt))] = trim(substr($response[$i], ($splitAt + 1)));
		} // END for ($i=0; $i<count($response); $i++)


		// Return the output
		return $output;


	} // END function requestPost()

	function getToken($thisString)
	{

		// List the possible tokens
		$Tokens = array(
			"Status",
			"StatusDetail",
			"VendorTxCode",
			"VPSTxId",
			"TxAuthNo",
			"Amount",
			"AVSCV2",
			"AddressResult",
			"PostCodeResult",
			"CV2Result",
			"GiftAid",
			"3DSecureStatus",
			"CAVV",
			"AddressStatus",
			"CardType",
			"Last4Digits",
			"PayerStatus", "CardType");


		// Initialise arrays
		$output = array();
		$resultArray = array();

		// Get the next token in the sequence
		for ($i = count($Tokens) - 1; $i >= 0; $i--)
		{
			// Find the position in the string
			$start = strpos($thisString, $Tokens[$i]);
			// If it's present
			if ($start !== false)
			{
				// Record position and token name
				$resultArray[$i]->start = $start;
				$resultArray[$i]->token = $Tokens[$i];
			}
		}

		// Sort in order of position
		sort($resultArray);
		// Go through the result array, getting the token values
		for ($i = 0; $i < count($resultArray); $i++)
		{
			// Get the start point of the value
			$valueStart = $resultArray[$i]->start + strlen($resultArray[$i]->token) + 1;
			// Get the length of the value
			if ($i == (count($resultArray) - 1))
			{
				$output[$resultArray[$i]->token] = substr($thisString, $valueStart);
			}
			else
			{
				$valueLength = $resultArray[$i + 1]->start - $resultArray[$i]->start - strlen($resultArray[$i]->token) - 2;
				$output[$resultArray[$i]->token] = substr($thisString, $valueStart, $valueLength);
			}

		}

		// Return the ouput array
		return $output;
	}

	function base64Encode($plain)
	{
		// Initialise output variable
		$output = "";

		// Do encoding
		$output = base64_encode($plain);

		// Return the result
		return $output;
	}

	function base64Decode($scrambled)
	{
		// Initialise output variable
		$output = "";

		// Fix plus to space conversion issue
		$scrambled = str_replace(" ", "+", $scrambled);

		// Do encoding
		$output = base64_decode($scrambled);

		// Return the result
		return $output;
	}

	function simpleXor($InString, $Key)
	{
		// Initialise key array
		$KeyList = array();
		// Initialise out variable
		$output = "";

		// Convert $Key into array of ASCII values
		for ($i = 0; $i < strlen($Key); $i++)
		{
			$KeyList[$i] = ord(substr($Key, $i, 1));
		}

		// Step through string a character at a time
		for ($i = 0; $i < strlen($InString); $i++)
		{
			// Get ASCII code from string, get ASCII code from key (loop through with MOD), XOR the two, get the character from the result
			// % is MOD (modulus), ^ is XOR
			$output .= chr(ord(substr($InString, $i, 1)) ^ ($KeyList[$i % strlen($Key)]));
		}

		// Return the result
		return $output;
	}

}