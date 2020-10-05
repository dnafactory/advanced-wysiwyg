<?php 

namespace DNAFactory\AdvancedWysiwyg\Plugin\Magento\Cms\Model\Wysiwyg\Images;

class Storage
{
    /**
     * @var \DNAFactory\AdvancedWysiwyg\Helper\Settings
     */
    protected $_settings;

	protected $_type;

	public function __construct(
        \DNAFactory\AdvancedWysiwyg\Helper\Settings $helperSettings
    ){
    	$this->_settings = $helperSettings;
    }

	public function beforeGetAllowedExtensions(
		\Magento\Cms\Model\Wysiwyg\Images\Storage $subject,
		$type
	){
		$this->_type = $type;
	}
	
	public function afterGetAllowedExtensions(
		\Magento\Cms\Model\Wysiwyg\Images\Storage $subject,
		$result
	){
        return array_merge($result,$this->_settings->getExtraFiletypes());
	}
}
