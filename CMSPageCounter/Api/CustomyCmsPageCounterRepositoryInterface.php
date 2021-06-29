<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;

/**
 * Interface CustomyCmsPageCounterRepositoryInterface
 * @package MI\CMSPageCounter\Api
 */
interface CustomyCmsPageCounterRepositoryInterface
{
    /**
     * Save customy_cms_page_counter
     * @param \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface $customyCmsPageCounter
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(
        CustomyCmsPageCounterInterface $customyCmsPageCounter
    );

    /**
     * Retrieve customy_cms_page_counter
     * @param string $customyCmsPageCounterId
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(string $customyCmsPageCounterId);

    /**
     * Retrieve customy_cms_page_counter matching the specified criteria
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterSearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete customy_cms_page_counter
     * @param \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface $customyCmsPageCounter
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(
        CustomyCmsPageCounterInterface $customyCmsPageCounter
    );

    /**
     * Delete customy_cms_page_counter by ID
     * @param string $customyCmsPageCounterId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(string $customyCmsPageCounterId);
}
