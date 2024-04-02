<?php

declare(strict_types=1);

namespace Caraque\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action implements HttpGetActionInterface
{
  const ADMIN_RESOURCE = 'Caraque_Minerva::faq_save';

  
  /**
   * Edit constructor
   * @param Context $context
   * @param PageFactory $pageFactory
   */
  public function __construct(
    Context $context,
    protected PageFactory $pageFactory
  ) {
    parent::__construct($context);
  }

  /**
   * @return Page
   */
  public function execute(): Page
  {
    $page = $this->pageFactory->create();
    $page->setActiveMenu('Caraque_Minerva::faq');
    $page->getConfig()->getTitle()->prepend(__('Edit FAQ'));

    return $page;
  }
}