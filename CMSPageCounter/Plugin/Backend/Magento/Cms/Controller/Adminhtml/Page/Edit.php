<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Plugin\Backend\Magento\Cms\Controller\Adminhtml\Page;

use Magento\Cms\Controller\Adminhtml\Page\Edit as PageEdit;
use MI\CMSPageCounter\Api\CustomyCmsPageCounterManagementInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;

/**
 * Class Edit
 * @package MI\CMSPageCounter\Plugin\Backend\Magento\Cms\Controller\Adminhtml\Page
 */
class Edit
{
    /**
     * @var CustomyCmsPageCounterManagementInterface
     */
    private $customyCmsPageCounterManagement;

    /**
     * Edit constructor
     * @param CustomyCmsPageCounterManagementInterface $customyCmsPageCounterManagement
     */
    public function __construct(
        CustomyCmsPageCounterManagementInterface $customyCmsPageCounterManagement
    ) {
        $this->customyCmsPageCounterManagement = $customyCmsPageCounterManagement;
    }

    /**
     * @param PageEdit $subject
     * @return array
     */
    public function beforeExecute(PageEdit $subject): array
    {
        if ($this->customyCmsPageCounterManagement->isEnabled()) {
            $this->customyCmsPageCounterManagement
                ->initCmsPageCounterEntity($subject->getRequest()->getParam('page_id'))
                ->incrementCmsPageCounter(CustomyCmsPageCounterInterface::BACKEND_COUNTER)
                ->saveCmsPageCounter();
        }

        return [];
    }
}
