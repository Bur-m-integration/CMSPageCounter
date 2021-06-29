<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Api;

/**
 * Interface CustomyCmsPageCounterManagementInterface
 * @package MI\CMSPageCounter\Api
 */
interface CustomyCmsPageCounterManagementInterface
{
    /**
     * @return string
     */
    public function isEnabled(): string;

    /**
     * @param string $pageId
     * @return $this
     */
    public function initCmsPageCounterEntity(string $pageId);

    /**
     * @param string $typeOfCmsPage
     * @return $this
     */
    public function incrementCmsPageCounter(string $typeOfCmsPage);

    /**
     * @return $this
     */
    public function saveCmsPageCounter();
}
