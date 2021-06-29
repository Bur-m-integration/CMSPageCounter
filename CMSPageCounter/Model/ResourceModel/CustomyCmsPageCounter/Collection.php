<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Model\ResourceModel\CustomyCmsPageCounter;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;

/**
 * Class Collection
 * @package MI\CMSPageCounter\Model\ResourceModel\CustomyCmsPageCounter
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = CustomyCmsPageCounterInterface::ID;

    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \MI\CMSPageCounter\Model\CustomyCmsPageCounter::class,
            \MI\CMSPageCounter\Model\ResourceModel\CustomyCmsPageCounter::class
        );
    }
}
