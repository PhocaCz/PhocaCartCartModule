<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

HTMLHelper::_('bootstrap.dropdown', '.dropdown', []);

?><div class="ph-cart-module-box <?php echo $moduleclass_sfx ;?>">
	<div class="dropdown">
    <button class="btn btn-outline-secondary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="<?php echo $s['i']['shopping-cart'] ?>"></span> <sup class="ph-cart-count-sup phItemCartBoxCount" id="phItemCartBoxCount"><?php echo $cart->getCartCountItems(); ?></sup>
    </button>

	  <div class="dropdown-menu dropdown-menu-end">
		  <div id="phItemCartBox" class="ph-item-cart-box phItemCartBox">
        <?php echo $cart->render(); ?>
      </div>
	  </div>
	</div>
</div>
