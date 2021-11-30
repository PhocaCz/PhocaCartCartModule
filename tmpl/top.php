<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die;
?><div class="ph-cart-module-box <?php echo $moduleclass_sfx ;?>">
	<div class="dropdown parent" data-g-hover-expand="true">
	  <div class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true" data-g-menuparent="true"><span class="<?php echo $s['i']['shopping-cart'] ?>"></span> <sup class="ph-cart-count-sup phItemCartBoxCount" id="phItemCartBoxCount"><?php echo $cart->getCartCountItems(); ?></sup></div>
	  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="phItemCartBox">
		<div id="phItemCartBox" class="ph-item-cart-box phItemCartBox"><?php echo $cart->render(); ?></div>
	  </div>
	</div>
</div>