<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;

/**
 * Class CustomyCmsPageCounter
 * @package MI\CMSPageCounter\Model\ResourceModel
 */
class CustomyCmsPageCounter extends AbstractDb
{
    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            CustomyCmsPageCounterInterface::CUSTOMY_CMS_PAGE_COUNTER_TABLE,
            CustomyCmsPageCounterInterface::ID
        );
    }
}
