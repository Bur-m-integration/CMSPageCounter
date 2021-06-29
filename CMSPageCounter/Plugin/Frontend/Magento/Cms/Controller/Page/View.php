<?php
declare(strict_types=1);

namespace MI\CMSPageCounter\Plugin\Frontend\Magento\Cms\Controller\Page;

use Magento\Cms\Controller\Page\View as PageView;
use MI\CMSPageCounter\Api\CustomyCmsPageCounterManagementInterface;
use MI\CMSPageCounter\Api\Data\CustomyCmsPageCounterInterface;

/**
 * Class View
 * @package MI\CMSPageCounter\Plugin\Frontend\Magento\Cms\Controller\Page
 */
class View
{
    /**
     * @var CustomyCmsPageCounterManagementInterface
     */
    private $customyCmsPageCounterManagement;

    /**
     * View constructor
     * @param CustomyCmsPageCounterManagementInterface $customyCmsPageCounterManagement
     */
    public function __construct(
        CustomyCmsPageCounterManagementInterface $customyCmsPageCounterManagement
    ) {
        $this->customyCmsPageCounterManagement = $customyCmsPageCounterManagement;
    }

    /**
     * @param PageView $subject
     * @return array
     */
    public function beforeExecute(PageView $subject): array
    {
        if ($this->customyCmsPageCounterManagement->isEnabled()) {
            $this->customyCmsPageCounterManagement
                ->initCmsPageCounterEntity($subject->getRequest()->getParam(
                    'page_id',
                    $subject->getRequest()->getParam('id', false)
                ))
                ->incrementCmsPageCounter(CustomyCmsPageCounterInterface::FRONTEND_COUNTER)
                ->saveCmsPageCounter();
        }

        return [];
    }
}
