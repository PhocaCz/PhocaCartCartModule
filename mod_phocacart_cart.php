<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die;// no direct access

if (!JComponentHelper::isEnabled('com_phocacart', true)) {
	$app = JFactory::getApplication();
	$app->enqueueMessage(JText::_('Phoca Cart Error'), JText::_('Phoca Cart is not installed on your system'), 'error');
	return;
}

JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');

/*
if (! class_exists('PhocacartLoader')) {
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
phocacartimport('phocacart.coupon.coupon');
phocacartimport('phocacart.date.date');
phocacartimport('phocacart.render.renderjs');
phocacartimport('phocacart.file.filethumbnail');
phocacartimport('phocacart.tax.tax');*/

$lang = JFactory::getLanguage();
//$lang->load('com_phocacart.sys');
$lang->load('com_phocacart');

JHTML::stylesheet('media/com_phocacart/css/main.css' );

$app	= JFactory::getApplication();
$cart	= new PhocacartCartRendercart();

$moduleclass_sfx 						= htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
$cart->params['display_image'] 			= $params->get( 'display_image', 0 );
$cart->params['display_checkout_link'] 	= $params->get( 'display_checkout_link', 1 );

$p									= array();
$p['load_component_media']			= $params->get( 'load_component_media', 0 );

if ($p['load_component_media'] == 1) {
	$media = new PhocacartRenderMedia();
	$media->loadBootstrap();
} else {
	JHTML::stylesheet('media/com_phocacart/css/main.css' );
}

$cart->setFullItems();
//echo '<div class="ph-cart-module-box"><div id="phItemCartBox">';

// We still not in database, when shipping or payment change
// we need to reflect it the same way standard checkout does
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

$cart->roundTotalAmount();


//echo $cart->render();
//echo '</div></div>';

require(JModuleHelper::getLayoutPath('mod_phocacart_cart'));
?>