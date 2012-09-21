<?php
/**
 * @copyright Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license GNU/GPL, see license.txt or http://www.gnu.org/copyleft/gpl.html
 * Developed by email@recomponent.com - redCOMPONENT.com
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
defined ( '_JEXEC' ) or die ( 'Restricted access' );

$uri = JURI::getInstance ();
$url = $uri->root ();
?>
<table class="admintable" width="100%">
<tr><td class="config_param"><?php echo JText::_( 'COM_REDSHOP_GENERAL_LAYOUT_SETTING' ); ?></td></tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('COM_REDSHOP_TOOLTIP_PAGINATION_LBL' ); ?>::<?php echo JText::_('COM_REDSHOP_TOOLTIP_PAGINATION' ); ?>">
		<label for="pagination"><?php echo JText::_('COM_REDSHOP_PAGINATION_LBL' ); ?></label></span>
		</td>
		<td><?php echo $this->lists ['pagination']; ?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_DEFAULT_PRODUCT_ORDERING_METHOD_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_DEFAULT_PRODUCT_ORDERING_METHOD_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_DEFAULT_PRODUCT_ORDERING_METHOD_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['default_product_ordering_method'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_DEFAULT_MANUFACTURER_ORDERING_METHOD_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_DEFAULT_MANUFACTURER_ORDERING_METHOD_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_DEFAULT_MANUFACTURER_ORDERING_METHOD_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['default_manufacturer_ordering_method'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_DEFAULT_MANUFACTURER_PRODUCT_ORDERING_METHOD_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_DEFAULT_MANUFACTURER_PRODUCT_ORDERING_METHOD_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_DEFAULT_MANUFACTURER_PRODUCT_ORDERING_METHOD_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['default_manufacturer_product_ordering_method'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_MANUFACTURER_TITLE_MAX_CHARS' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_MANUFACTURER_TITLE_MAX_CHARS_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_MANUFACTURER_MAX_CHARS_LBL' );?></label></span>
		</td>
		<td>
		<input type="text" name="manufacturer_title_max_chars" id="manufacturer_title_max_chars" value="<?php echo MANUFACTURER_TITLE_MAX_CHARS;	?>">
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_MANUFACTURER_TITLE_END_SUFFIX' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_MANUFACTURER_TITLE_END_SUFFIX_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_MANUFACTURER_TITLE_END_SUFFIX_LBL' );?></label></span>
		</td>
		<td>
		<input type="text" name="manufacturer_title_end_suffix" id="manufacturer_title_end_suffix" value="<?php echo MANUFACTURER_TITLE_END_SUFFIX;?>">
		</td>
	</tr>
	<tr><td colspan="2"><hr /></td></tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_DEFAULT_IMAGE_QUALITY_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_IMAGE_QUALITY_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_IMAGE_QUALITY_LBL' );?></label></span>
		</td>
		<td>		<input type="text" name="image_quality_output" id="image_quality_output" value="<?php echo IMAGE_QUALITY_OUTPUT;?>" />
		</td>
	</tr>

	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_CAT_IS_LIGHTBOX' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_CAT_IS_LIGHTBOX' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_CAT_IS_LIGHTBOX' );?></label></span>
		</td>
		<td><?php echo $this->lists ['cat_is_lightbox'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_PRODUCT_ADDIMG_IS_LIGHTBOX_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_PRODUCT_ADDIMG_IS_LIGHTBOX_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_PRODUCT_ADDIMG_IS_LIGHTBOX_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['product_addimg_is_lightbox'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_PRODUCT_IS_LIGHTBOX_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_PRODUCT_IS_LIGHTBOX' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_PRODUCT_IS_LIGHTBOX_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['product_is_lightbox'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_PRODUCT_DETAIL_IS_LIGHTBOX_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_PRODUCT_DETAIL_IS_LIGHTBOX' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_PRODUCT_DETAIL_IS_LIGHTBOX_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['product_detail_is_lightbox'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_USE_PRODUCT_RESERVE_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_USE_PRODUCT_RESERVE_LBL' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_USE_PRODUCT_RESERVE_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['is_product_reserve'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_USE_PRODUCT_OUTOFSTOCK_IMAGE_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_USE_PRODUCT_OUTOFSTOCK_IMAGE' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_USE_PRODUCT_OUTOFSTOCK_IMAGE_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['use_product_outofstock_image'];?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_ENABLE_ADDRESS_DETAIL_IN_SHIPPING_LBL' ); ?>::<?php echo JText::_( 'COM_REDSHOP_TOOLTIP_ENABLE_ADDRESS_DETAIL_IN_SHIPPING' ); ?>">
		<label for="name"><?php echo JText::_ ( 'COM_REDSHOP_ENABLE_ADDRESS_DETAIL_IN_SHIPPING_LBL' );?></label></span>
		</td>
		<td><?php echo $this->lists ['enable_address_detail_in_shipping'];?></td>
</table>
