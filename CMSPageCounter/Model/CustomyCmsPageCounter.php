<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterfaceFactory;
use MI\CMSPageCounter\Model\ResourceModel\CustomyCmsPageCounter as CustomyCmsPageCounterResourceModel;
use MI\CMSPageCounter\Model\ResourceModel\CustomyCmsPageCounter\Collection as CustomyCmsPageCounterCollection;

/**
 * Class CustomyCmsPageCounter
 * @package MI\CMSPageCounter\Model
 */
class CustomyCmsPageCounter extends AbstractModel
{
    /**
     * @var CustomyCmsPageCounterInterfaceFactory
     */
    protected $customyCmsPageCounterDataFactory;
    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;
    /**
     * @var string
     */
    protected $_eventPrefix = 'customy_cms_page_counter';

    /**
     * CustomyCmsPageCounter constructor
     * @param Context $context
     * @param Registry $registry
     * @param CustomyCmsPageCounterInterfaceFactory $customyCmsPageCounterDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param CustomyCmsPageCounterResourceModel $resource
     * @param CustomyCmsPageCounterCollection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        CustomyCmsPageCounterInterfaceFactory $customyCmsPageCounterDataFactory,
        DataObjectHelper $dataObjectHelper,
        CustomyCmsPageCounterResourceModel $resource,
        CustomyCmsPageCounterCollection $resourceCollection,
        array $data = []
    ) {
        $this->customyCmsPageCounterDataFactory = $customyCmsPageCounterDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve customy_cms_page_counter model with customy_cms_page_counter data
     * @return CustomyCmsPageCounterInterface
     */
    public function getDataModel(): CustomyCmsPageCounterInterface
    {
        $customyCmsPageCounterDataObject = $this->customyCmsPageCounterDataFactory->create();

        $this->dataObjectHelper->populateWithArray(
            $customyCmsPageCounterDataObject,
            $this->getData(),
            CustomyCmsPageCounterInterface::class
        );

        return $customyCmsPageCounterDataObject;
    }
}
