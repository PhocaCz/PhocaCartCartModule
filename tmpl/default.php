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
// Add them to DIV ID because they will be changed per AJAX
// $count = $cart->getCartCountItems();
// echo '<div class="phItemCartBoxCount" id="phItemCartBoxCount">'. $cart->getCartCountItems().'</div>';
// $total = $cart->getCartTotalItems();
// echo '<div class="phItemCartBoxTotal" id="phItemCartBoxTotal">'. $cart->getCartTotalItems().'</div>';
?>
