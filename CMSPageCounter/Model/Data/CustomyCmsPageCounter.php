<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterExtensionInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;

/**
 * Class CustomyCmsPageCounter
 * @package MI\CMSPageCounter\Model\Data
 */
class CustomyCmsPageCounter extends AbstractExtensibleObject implements CustomyCmsPageCounterInterface
{
    /**
     * Get id
     * @return string|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get cms_page_id
     * @return string|null
     */
    public function getCmsPageId()
    {
        return $this->_get(self::CMS_PAGE_ID);
    }

    /**
     * Set cms_page_id
     * @param string $cmsPageId
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setCmsPageId($cmsPageId)
    {
        return $this->setData(self::CMS_PAGE_ID, $cmsPageId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object
     * @param \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        CustomyCmsPageCounterExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get backend_counter
     * @return string|null
     */
    public function getBackendCounter()
    {
        return $this->_get(self::BACKEND_COUNTER);
    }

    /**
     * Set backend_counter
     * @param string $backendCounter
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setBackendCounter($backendCounter)
    {
        return $this->setData(self::BACKEND_COUNTER, $backendCounter);
    }

    /**
     * Get frontend_counter
     * @return string|null
     */
    public function getFrontendCounter()
    {
        return $this->_get(self::FRONTEND_COUNTER);
    }

    /**
     * Set frontend_counter
     * @param string $frontendCounter
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setFrontendCounter($frontendCounter)
    {
        return $this->setData(self::FRONTEND_COUNTER, $frontendCounter);
    }
}
