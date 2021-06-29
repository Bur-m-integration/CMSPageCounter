<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use MI\CMSPageCounter\Api\CustomyCmsPageCounterRepositoryInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterfaceFactory;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterSearchResultsInterfaceFactory;
use MI\CMSPageCounter\Model\ResourceModel\CustomyCmsPageCounter as ResourceCustomyCmsPageCounter;
use MI\CMSPageCounter\Model\ResourceModel\CustomyCmsPageCounter\CollectionFactory as CustomyCmsPageCounterCollectionFactory;

/**
 * Class CustomyCmsPageCounterRepository
 * @package MI\CMSPageCounter\Model
 */
class CustomyCmsPageCounterRepository implements CustomyCmsPageCounterRepositoryInterface
{
    /**
     * @var ResourceCustomyCmsPageCounter
     */
    protected $resource;
    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;
    /**
     * @var CustomyCmsPageCounterSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @var CustomyCmsPageCounterInterfaceFactory
     */
    protected $dataCustomyCmsPageCounterFactory;
    /**
     * @var CustomyCmsPageCounterCollectionFactory
     */
    protected $customyCmsPageCounterCollectionFactory;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;
    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;
    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var CustomyCmsPageCounterFactory
     */
    protected $customyCmsPageCounterFactory;

    /**
     * CustomyCmsPageCounterRepository constructor
     * @param ResourceCustomyCmsPageCounter $resource
     * @param CustomyCmsPageCounterFactory $customyCmsPageCounterFactory
     * @param CustomyCmsPageCounterInterfaceFactory $dataCustomyCmsPageCounterFactory
     * @param CustomyCmsPageCounterCollectionFactory $customyCmsPageCounterCollectionFactory
     * @param CustomyCmsPageCounterSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCustomyCmsPageCounter $resource,
        CustomyCmsPageCounterFactory $customyCmsPageCounterFactory,
        CustomyCmsPageCounterInterfaceFactory $dataCustomyCmsPageCounterFactory,
        CustomyCmsPageCounterCollectionFactory $customyCmsPageCounterCollectionFactory,
        CustomyCmsPageCounterSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->customyCmsPageCounterFactory = $customyCmsPageCounterFactory;
        $this->customyCmsPageCounterCollectionFactory = $customyCmsPageCounterCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomyCmsPageCounterFactory = $dataCustomyCmsPageCounterFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * Save customy_cms_page_counter
     * @param \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface $customyCmsPageCounter
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(
        CustomyCmsPageCounterInterface $customyCmsPageCounter
    ) {
        $customyCmsPageCounterData = $this->extensibleDataObjectConverter->toNestedArray(
            $customyCmsPageCounter,
            [],
            \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface::class
        );

        $customyCmsPageCounterModel = $this->customyCmsPageCounterFactory->create()->setData($customyCmsPageCounterData);

        try {
            $this->resource->save($customyCmsPageCounterModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customyCmsPageCounter: %1',
                $exception->getMessage()
            ));
        }

        return $customyCmsPageCounterModel->getDataModel();
    }

    /**
     * Retrieve customy_cms_page_counter
     * @param string $customyCmsPageCounterId
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(string $customyCmsPageCounterId)
    {
        $customyCmsPageCounter = $this->customyCmsPageCounterFactory->create();
        $this->resource->load($customyCmsPageCounter, $customyCmsPageCounterId);

        if (!$customyCmsPageCounter->getId()) {
            throw new NoSuchEntityException(__('customy_cms_page_counter with id "%1" does not exist.', $customyCmsPageCounterId));
        }

        return $customyCmsPageCounter->getDataModel();
    }

    /**
     * Retrieve customy_cms_page_counter matching the specified criteria
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterSearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ) {
        $collection = $this->customyCmsPageCounterCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface::class
        );
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete customy_cms_page_counter
     * @param \MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface $customyCmsPageCounter
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(
        CustomyCmsPageCounterInterface $customyCmsPageCounter
    ) {
        try {
            $customyCmsPageCounterModel = $this->customyCmsPageCounterFactory->create();

            $this->resource->load($customyCmsPageCounterModel, $customyCmsPageCounter->getId());
            $this->resource->delete($customyCmsPageCounterModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the customy_cms_page_counter: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * Delete customy_cms_page_counter by ID
     * @param string $customyCmsPageCounterId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(string $customyCmsPageCounterId)
    {
        return $this->delete($this->get($customyCmsPageCounterId));
    }
}
