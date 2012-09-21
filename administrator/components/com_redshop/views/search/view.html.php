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

defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.application.component.view' );

class searchViewsearch extends JView
{
	function __construct( $config = array())
	{
		 parent::__construct( $config );
	}

	function display($tpl = null)
	{
		global $mainframe;

   		//$decoded = json_decode($_GET['json']);

		$doc = JFactory::getDocument ();

		$doc->addStyleSheet ( 'components/com_redshop/assets/css/search.css' );

		$doc->addScript ('components/com_redshop/assets/js/search.js');

	//	$aid = $decoded->aid;

		$search_detail	= $this->get('data');


		$this->assignRef('detail',$search_detail);

   		 parent::display($tpl);
  }
}
