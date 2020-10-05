<?php

namespace DNAFactory\AdvancedWysiwyg\Image\Adapter;

class Gd2 extends \Magento\Framework\Image\Adapter\Gd2
{
    /**
     * @var \DNAFactory\AdvancedWysiwyg\Helper\Settings
     */
    protected $settings;

    public function __construct(
        \Magento\Framework\Filesystem $filesystem,
        \Psr\Log\LoggerInterface $logger,
        \DNAFactory\AdvancedWysiwyg\Helper\Settings $helperSettings,
        array $data = []
    ) {
        $this->settings = $helperSettings;

        parent::__construct($filesystem, $logger, $data);
    }


    /**
     * @param string $filename
     * @return void
     * @throws \OverflowException
     */
    public function open($filename)
    {
        $pathInfo = pathinfo($filename);
        if (!key_exists('extension', $pathInfo) || !in_array($pathInfo['extension'], $this->settings->getExtraFiletypes())) {
            parent::open($filename);
        }
    }

    /**
     * @param null|string $destination
     * @param null|string $newName
     * @return void
     * @throws \Exception  If destination path is not writable
     */
    public function save($destination = null, $newName = null)
    {
        $fileName = $this->_prepareDestination($destination, $newName);
        $pathInfo = pathinfo($fileName);
        if (!key_exists('extension', $pathInfo) || !in_array($pathInfo['extension'], $this->settings->getExtraFiletypes())) {
            parent::save($destination, $newName);
        }
    }
}
