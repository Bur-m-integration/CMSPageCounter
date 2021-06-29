<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface CustomyCmsPageCounterInterface
 * @package MI\CMSPageCounter\Api\Data
 */
interface CustomyCmsPageCounterInterface extends ExtensibleDataInterface
{
    // Table name
    const CUSTOMY_CMS_PAGE_COUNTER_TABLE = 'customy_cms_page_counter';

    // Table fields
    const ID = 'id';
    const CMS_PAGE_ID = 'cms_page_id';
    const FRONTEND_COUNTER = 'frontend_counter';
    const BACKEND_COUNTER = 'backend_counter';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setId($id);

    /**
     * Get cms_page_id
     * @return string|null
     */
    public function getCmsPageId();

    /**
     * Set cms_page_id
     * @param string $cmsPageId
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setCmsPageId($cmsPageId);

    /**
     * Retrieve existing extension attributes object or create a new one
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object
     * @param \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        CustomyCmsPageCounterExtensionInterface $extensionAttributes
    );

    /**
     * Get backend_counter
     * @return string|null
     */
    public function getBackendCounter();

    /**
     * Set backend_counter
     * @param string $backendCounter
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setBackendCounter($backendCounter);

    /**
     * Get frontend_counter
     * @return string|null
     */
    public function getFrontendCounter();

    /**
     * Set frontend_counter
     * @param string $frontendCounter
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     */
    public function setFrontendCounter($frontendCounter);
}
