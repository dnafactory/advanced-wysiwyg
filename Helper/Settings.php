<?php

namespace DNAFactory\AdvancedWysiwyg\Helper;

use Magento\Framework\App\Helper\Context;

class Settings extends \Magento\Framework\App\Helper\AbstractHelper
{
	const CONFIG_PATH_FILETYPES = 'wysiwyg/filetypes';

    public $configPathModule = 'cms';
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Currently selected store ID if applicable
     *
     * @var int
     */
    protected $_storeId;

    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreId()
    {
        if (!$this->_storeId){
            $this->_storeId = $this->_storeManager->getStore()->getId();
        }
        return $this->_storeId;
    }

    /**
     * @param int $store
     * @return $this
     */
    public function setStoreId(int $store)
    {
        $this->_storeId = $store;
        return $this;
    }

    public function getConfigValue($path)
    {
        if (substr_count($path, '/') < 2){
            $path = $this->configPathModule . '/' . $path;
        }
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }

	public function getExtraFiletypes()
	{
      $filetypes = array();
      $settings = json_decode($this->getConfigValue(self::CONFIG_PATH_FILETYPES));
      if ($settings) {
          foreach($settings as $setting){
              $filetypes[] =  $setting->extension;
          }
      }
      $defaultFiletypes = array('doc','docm','docx','csv','xml','xls','xlsx','pdf','zip','tar');
      return array_merge($filetypes,$defaultFiletypes);
	}

}
