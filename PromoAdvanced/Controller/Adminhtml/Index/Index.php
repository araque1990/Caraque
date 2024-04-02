<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
  const ADMIN_RESOURCE = 'Caraque_PromoAdvanced::promo_admin_grid';
  public function __construct(
    Context $context,
    private readonly PageFactory $pageFactory
  ) {
    parent::__construct($context);
  }

  public function execute(): Page
  {
    /** @var Page $page */
    $page = $this->pageFactory->create();
    $page->getConfig()->getTitle()->prepend(__('Advanced Promotions'));

    return $page;
  }
}
