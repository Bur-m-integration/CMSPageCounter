<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CustomyCmsPageCounterSearchResultsInterface
 * @package MI\CMSPageCounter\Api\Data
 */
interface CustomyCmsPageCounterSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get customy_cms_page_counter list
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface[]
     */
    public function getItems();

    /**
     * Set cms_page_id list
     * @param \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
