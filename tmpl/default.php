<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die;
?>
<div class="ph-cart-module-box <?php echo $moduleclass_sfx ;?>">
	<div class="phItemCartBox" id="phItemCartBox">
		<?php echo $cart->render(); ?>
	</div>
</div>
<?php
// Get count of items and get Total (include coupons)
// Both variables can be used e.g. if the cart is hidden and slide up is used
// Add them to DIV ID because they will change per AJAX
// Count
// <div class="phItemCartBoxCount"><Xphp echo $cart->getCartCountItems(); X></div>

// Total amount
// $price = new PhocacartPrice();
// $total = $cart->getCartTotalItems();
// <div class="phItemCartBoxTotal"><Xphp echo $price->getPriceFormat($total[0]['brutto']); X></div>
?>
