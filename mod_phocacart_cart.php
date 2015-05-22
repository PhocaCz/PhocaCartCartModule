<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die('Restricted access');// no direct access

if (!JComponentHelper::isEnabled('com_phocacart', true)) {
	return JError::raiseError(JText::_('Phoca Cart Error'), JText::_('Phoca Cart is not installed on your system'));
}
if (! class_exists('PhocaCartLoader')) {
    require_once( JPATH_ADMINISTRATOR.'/components/com_phocacart/libraries/loader.php');
}

phocacartimport('phocacart.utils.settings');
phocacartimport('phocacart.utils.utils');
phocacartimport('phocacart.path.path');
phocacartimport('phocacart.path.route');
phocacartimport('phocacart.currency.currency');
phocacartimport('phocacart.price.price');
phocacartimport('phocacart.cart.cart');
phocacartimport('phocacart.cart.cartdb');
phocacartimport('phocacart.cart.rendercart');
phocacartimport('phocacart.product.product');
phocacartimport('phocacart.attribute.attribute');

$lang = JFactory::getLanguage();
//$lang->load('com_phocacart.sys');
$lang->load('com_phocacart');

JHTML::stylesheet('media/com_phocacart/css/main.css' );

$app	= JFactory::getApplication();
$cart	= new PhocaCartRenderCart();
$cart->setFullItems();
echo '<div class="alert alert-info">';

// SHIPPING
$shippingEdit	= 0;
$shippingEdit	= $app->input->get('shippingedit', 0, 'int');
$shippingId 	= $cart->getShippingId();
if (isset($shippingId) && (int)$shippingId > 0 && $shippingEdit == 0) {
	$cart->addShippingCosts($shippingId);
}
// PAYMENT
$paymentEdit	= 0;
$paymentEdit	= $app->input->get('paymentedit', 0, 'int');
$paymentMethod 	= $cart->getPaymentMethod();
if (isset($paymentMethod['id']) && (int)$paymentMethod['id'] > 0 && $paymentEdit == 0) {
	$cart->addPaymentCosts($paymentMethod['id']);
}

echo $cart->render();
echo '</div>';
require(JModuleHelper::getLayoutPath('mod_phocacart_cart'));
?>