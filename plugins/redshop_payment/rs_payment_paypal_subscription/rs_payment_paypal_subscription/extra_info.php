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
require_once(JPATH_COMPONENT . DS . 'helpers' . DS . 'helper.php');
require_once (JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_redshop' . DS . 'helpers' . DS . 'redshop.cfg.php');
$objOrder = new order_functions();

$objconfiguration = new Redconfiguration();
$session =& JFactory::getSession();
$user = JFactory::getUser();
$shipping_address = $objOrder->getOrderShippingUserInfo($data['order_id']);
$Itemid = $_REQUEST['Itemid'];

$redhelper = new redhelper();
$db = JFactory::getDBO();
$user = JFActory::getUser();
$task = JRequest::getVar('task');
$layout = JRequest::getVar('layout');
$mainframe =& JFactory::getApplication();

if ($this->_params->get("currency") != "")
{
	$currency_main = $this->_params->get("currency");
}
else if (CURRENCY_CODE != "")
{
	$currency_main = CURRENCY_CODE;
}
else
{
	$currency_main = "USD";
}

$sql = "SELECT op.*,o.order_total,o.user_id,o.order_tax,o.order_subtotal,o.order_shipping,o.order_number,o.payment_discount FROM " . $this->_table_prefix . "order_payment AS op LEFT JOIN " . $this->_table_prefix . "orders AS o ON op.order_id = o.order_id  WHERE o.order_id='" . $data['order_id'] . "'";
$db->setQuery($sql);
$order_details = $db->loadObjectList();


if ($this->_params->get("sandbox") == '1')
{
	$paypalurl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
}
else
{
	$paypalurl = "https://www.paypal.com/cgi-bin/webscr";
}
$currencyClass = new convertPrice ();

$order->order_subtotal = $currencyClass->convert($order_details[0]->order_total, '', $currency_main);
$order->order_subtotal = number_format($order->order_subtotal, 2);


$subscription_id = $session->get('subscription_id');

$post_variables = Array(
	"cmd"                => "_xclick-subscriptions",
	"business"           => $this->_params->get("merchant_email"),
	"receiver_email"     => $this->_params->get("merchant_email"),
	"item_name"          => JTEXT::_('ORDER_ID_LBL') . ":" . $data['order_id'],
	"rm"                 => '2',
	"item_number"        => $data['order_id'],
	"invoice"            => $order_details[0]->order_number,
	"return"             => JURI::base() . "index.php?option=com_redshop&view=order_detail&oid=" . $data['order_id'],
	"night_phone_b"      => substr($data['billinginfo']->phone, 0, 25),
	"cancel_return"      => JURI::base() . "index.php",
	"undefined_quantity" => "0",
	"test_ipn"           => $this->_params->get("is_test"),
	"pal"                => "NRUBJXESJTY24",
	"no_shipping"        => "0",
	"no_note"            => "1",
	"currency_code"      => $currency_main,
	"a3"                 => $order->order_subtotal,
	"p3"                 => "1",
	"t3"                 => "M",
	"src"                => "1",
	"sra"                => "1",
	"srt"                => $subscription_id

);



if (SHIPPING_METHOD_ENABLE)
{
	$shipping_variables = Array(
		"address1"   => $shipping_address->address,
		"city"       => $shipping_address->city,
		"country"    => $CountryCode2,
		"first_name" => $shipping_address->firstname,
		"last_name"  => $shipping_address->lastname,
		"state"      => $shipping_address->state_code,
		"zip"        => $shipping_address->zipcode
	);
}

$payment_price = $this->_params->get("payment_price");

$post_variables['discount_amount_cart'] = round($currencyClass->convert($data['odiscount'], '', $currency_main), 2);
$post_variables['discount_amount_cart'] += round($currencyClass->convert($data['special_discount'], '', $currency_main), 2);
if ($this->_params->get("payment_oprand") == '-')
{
	$discount_payment_price = $payment_price;
	$post_variables['discount_amount_cart'] += round($currencyClass->convert($order_details[0]->payment_discount, '', $currency_main), 2);

}
else
{
	$discount_payment_price = $payment_price;
	$post_variables['handling_cart'] = round($currencyClass->convert($order_details[0]->payment_discount, '', $currency_main), 2);
}


echo "<form action='$paypalurl' method='post' id='paypalfrm' name='paypalfrm'>";
echo "<h3>" . JTEXT::_('PAYPAL_WAIT_MESSAGE') . "</h3>";
foreach ($post_variables as $name => $value)
{
	echo "<input type='hidden' name='$name' value='$value' />";
}

if (SHIPPING_METHOD_ENABLE)
{
	if (is_array($shipping_variables) && count($shipping_variables))
	{
		foreach ($shipping_variables as $name => $value)
		{
			echo '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
		}
	}
}
echo '<INPUT TYPE="hidden" name="charset" value="utf-8">';
echo "</form>";
?>
<script type='text/javascript'>document.paypalfrm.submit();</script>