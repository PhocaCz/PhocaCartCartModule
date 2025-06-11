<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die;// no direct access

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;

$app = Factory::getApplication();

if (!ComponentHelper::isEnabled('com_phocacart', true)) {
	$app->enqueueMessage(Text::_('Phoca Cart Error'), Text::_('Phoca Cart is not installed on your system'), 'error');
	return;
}
if (file_exists(JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/bootstrap.php')) {
	// Joomla 5 and newer
	require_once(JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/bootstrap.php');
} else {
	// Joomla 4
	JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');
}

$lang = Factory::getLanguage();
//$lang->load('com_phocacart.sys');
$lang->load('com_phocacart');

$cart	= new PhocacartCartRendercart();

$moduleclass_sfx 						= htmlspecialchars((string)$params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
$cart->params['display_image'] 			= $params->get( 'display_image', 0 );
$cart->params['display_checkout_link'] 	= $params->get( 'display_checkout_link', 1 );
$cart->params['display_product_tax_info'] 	= $params->get( 'display_product_tax_info', 0 );

$s = PhocacartRenderStyle::getStyles();

$p									= array();
$p['load_component_media']			= $params->get( 'load_component_media', 1 );

if ($p['load_component_media'] == 1) {
	$media = PhocacartRenderMedia::getInstance('main');
	$media->loadBase();
	$media->loadBootstrap();
	$media->loadSpec();
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
	$cart->addPaymentCosts($paymentMethod['id']);// validity of payment will be checked
}

$cart->roundTotalAmount();


//echo $cart->render();
//echo '</div></div>';

require(ModuleHelper::getLayoutPath('mod_phocacart_cart', $params->get('layout', 'default')));
?>
