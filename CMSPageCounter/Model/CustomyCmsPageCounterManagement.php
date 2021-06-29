<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\ScopeInterface;
use MI\CMSPageCounter\Api\CustomyCmsPageCounterManagementInterface;
use MI\CMSPageCounter\Api\CustomyCmsPageCounterRepositoryInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CustomyCmsPageCounterManagement
 * @package MI\CMSPageCounter\Model
 */
class CustomyCmsPageCounterManagement implements CustomyCmsPageCounterManagementInterface
{
    const CMS_PAGE_COUNTER_PATH = 'cms_page_counter_section/cms_page_counter_group/cms_page_counter_field';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var
     */
    private $cmsPageCounterEntity;
    /**
     * @var CustomyCmsPageCounterRepositoryInterface
     */
    private $customyCmsPageCounterRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var CustomyCmsPageCounter
     */
    private $customyCmsPageCounter;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * CustomyCmsPageCounterManagement constructor
     * @param ScopeConfigInterface $scopeConfig
     * @param CustomyCmsPageCounterRepositoryInterface $customyCmsPageCounterRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CustomyCmsPageCounter $customyCmsPageCounter
     * @param LoggerInterface $logger
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        CustomyCmsPageCounterRepositoryInterface $customyCmsPageCounterRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CustomyCmsPageCounter $customyCmsPageCounter,
        LoggerInterface $logger
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->customyCmsPageCounterRepository = $customyCmsPageCounterRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->customyCmsPageCounter = $customyCmsPageCounter;
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function isEnabled(): string
    {
        return (string)$this->scopeConfig->getValue(
            self::CMS_PAGE_COUNTER_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param CustomyCmsPageCounterInterface $cmsPageCounterEntity
     */
    private function setCmsPageCounterEntity(CustomyCmsPageCounterInterface $cmsPageCounterEntity)
    {
        $this->cmsPageCounterEntity = $cmsPageCounterEntity;
    }

    /**
     * @param string $pageId
     * @return $this
     */
    public function initCmsPageCounterEntity(string $pageId)
    {
        $this->searchCriteriaBuilder
            ->addFilter(CustomyCmsPageCounterInterface::CMS_PAGE_ID, $pageId, 'eq');
        $customyCmsPageCounterItem = $this->customyCmsPageCounterRepository
            ->getList($this->searchCriteriaBuilder->create())->getItems();

        if ($customyCmsPageCounterItem) {
            $cmsPageCounterEntity = $customyCmsPageCounterItem[0];
        } else {
            $cmsPageCounterEntity = $this->customyCmsPageCounter->getDataModel();
            $cmsPageCounterEntity->setCmsPageId($pageId);
        }

        $this->setCmsPageCounterEntity($cmsPageCounterEntity);

        return $this;
    }

    /**
     * @param string $typeOfCmsPage
     * @return $this
     */
    public function incrementCmsPageCounter(string $typeOfCmsPage)
    {
        switch ($typeOfCmsPage) {
            case CustomyCmsPageCounterInterface::BACKEND_COUNTER:
                $this->cmsPageCounterEntity->setBackendCounter(
                    $this->cmsPageCounterEntity->getBackendCounter() + 1
                );
                break;

            case CustomyCmsPageCounterInterface::FRONTEND_COUNTER:
                $this->cmsPageCounterEntity->setFrontendCounter(
                    $this->cmsPageCounterEntity->getFrontendCounter() + 1
                );
                break;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function saveCmsPageCounter()
    {
        try {
            $this->customyCmsPageCounterRepository->save($this->cmsPageCounterEntity);
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getLogMessage());
        }

        return $this;
    }
}
