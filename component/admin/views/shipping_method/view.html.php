<?php

/**
 * @package     RedSHOP.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2008 - 2019 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die;

/**
 * View shipping method
 *
 * @package     RedSHOP.Backend
 * @subpackage  View
 * @since       __DEPLOY_VERSION__
 */
class RedshopViewShipping_Method extends RedshopViewForm
{
    public function display($tpl = null)
    {
        RedshopHelperShipping::loadLanguages(true);

        return parent::display($tpl); // TODO: Change the autogenerated stub
    }

    /**
     * Method for prepare field HTML
     *
     * @param object $field Group object
     *
     * @return  boolean|string  False if keep. String for HTML content if success.
     *
     * @throws \Exception
     * @since   __DEPLOY_VERSION__
     */
    protected function prepareField($field)
    {
        switch ($field->getAttribute('name')) {
            case 'name':
            case 'element':
                if ($field->getAttribute('name') == 'element') {
                    $this->form->setFieldAttribute('element', 'label', JText::_('COM_REDSHOP_SHIPPING_CLASS'));
                }

                return RedshopLayoutHelper::render(
                    'shipping.shipping_method',
                    [
                        'field'   => $field,
                        'element' => $this->item->element
                    ]
                );
            case 'element_hidden':
                $this->hiddenFields[] = $this->form->getInput(
                    $field->getAttribute('name'),
                    null,
                    $this->item->element
                );

                return false;
            case 'plugin':
                $this->hiddenFields[] = $this->form->getInput(
                    $field->getAttribute('name'),
                    null,
                    $this->item->folder
                );

                return false;
            case 'version':
            case 'support_rate':
            case 'support_location':
                return false;
            case 'configuration':
                return RedshopLayoutHelper::render(
                    'shipping.shipping_config',
                    [
                        'item'    => $this->item,
                        'element' => $this->form->getField('element')->value
                    ]
                );
            default:
                return parent::prepareField($field);
        }
    }

    /**
     * Method for add toolbar.
     *
     * @return  void
     * @throws  Exception
     *
     * @since   __DEPLOY_VERSION__
     */
    protected function addToolbar()
    {
        $params      = new JRegistry($this->item->params);
        $hasRate     = $params->get('is_shipper');
        $hasLocation = $params->get('shipper_location');

        if ($hasRate) {
            JToolbarHelper::custom(
                'shipping_rate',
                'redshop_shipping_rates32',
                JText::_('COM_REDSHOP_SHIPPING_RATE_LBL'),
                JText::_('COM_REDSHOP_SHIPPING_RATE_LBL'),
                false
            );
        } elseif ($hasLocation) {
            JToolbarHelper::custom(
                'shipping_rate',
                'redshop_shipping_rates32',
                JText::_('COM_REDSHOP_SHIPPING_LOCATION'),
                JText::_('COM_REDSHOP_SHIPPING_LOCATION'),
                false
            );
        }
        parent::addToolbar(); // TODO: Change the autogenerated stub
    }
}
