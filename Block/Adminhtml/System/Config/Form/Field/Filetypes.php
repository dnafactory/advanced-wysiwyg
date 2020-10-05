<?php
 
namespace DNAFactory\AdvancedWysiwyg\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class Filetypes extends AbstractFieldArray
{

    /**
     * @return void
     */
    protected function _prepareToRender()
    {
        $this->addColumn(
            'extension',
            [
                'label'     => __('Formati Supportati'),
            ]
        );
		$this->_addAfter = false;
    }

}
