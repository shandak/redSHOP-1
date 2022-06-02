<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  Model
 *
 * @copyright   Copyright (C) 2008 - 2019 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\CMS\Factory;

defined('_JEXEC') or die;

/**
 * Model Zipcode Detail
 *
 * @package     RedSHOP.Backend
 * @subpackage  Model
 * @since       2.1.3
 */
class RedshopModelZipcode extends RedshopModelForm
{
    /**
     * Method to save a record.
     *
     * @param   array  $data  data
     *
     * @return  boolean
     *
     * @throws  Exception
     * @since   2.1.3
     */
    public function save($data)
    {
        /** @var RedshopTableZipcode $table */
        $table = $this->getTable('Zipcode');

        if ($data['zipcodeto'] && ($data['zipcode'] > $data['zipcodeto'])) {
            return false;
        }

        if (!$data['zipcodeto']) {
            $data['zipcodeto'] = $data['zipcode'];
        }

        for ($i = $data['zipcode']; $i <= $data['zipcodeto']; $i++) {
            $data['zipcode'] = is_numeric($data['zipcode']) ? $i : $data['zipcode'];

            if (!$table->bind($data) || !$table->docheck()) {
				Factory::getApplication()->enqueueMessage(JText::_('COM_REDSHOP_ZIPCODE_ALREADY_EXISTS') . ": " . $data['zipcode'], 'warning');

                continue;
            }

            parent::save($data);
        }

        return true;
    }
}
