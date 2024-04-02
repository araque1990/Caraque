<?php

declare(strict_types=1);

namespace Caraque\Minerva\Controller\Adminhtml\Faq;

use Caraque\Minerva\Model\Faq;
use Caraque\Minerva\Model\FaqFactory;
use Caraque\Minerva\Model\ResourceModel\Faq as ResourceModelFaq;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action implements HttpGetActionInterface
{
  const ADMIN_RESOURCE = 'Caraque_Minerva::faq_delete';


  /**
   * Edit constructor
   * @param Context $context
   * @param PageFactory $pageFactory
   * @var FaqFactory $faqFactory
   * @var ResourceModelFaq $faqResource
   */
  public function __construct(
    Context $context,
    protected PageFactory $pageFactory,
    protected FaqFactory $faqFactory,
    protected ResourceModelFaq $faqResource
  ) {
    parent::__construct($context);
  }

  /**
   * @return Page
   */
  public function execute(): Redirect
  {
    try {
      $id = $this->getRequest()->getParam('id');
      /** @var Faq $faq */
      $faq = $this->faqFactory->create();
      $this->faqResource->load($faq, $id);
      if ($faq->getId()) {
        $this->faqResource->delete($faq);
        $this->messageManager->addSuccessMessage(__('The record has been deleted'));
      } else {
        $this->messageManager->addErrorMessage(__('The record does not exist.'));
      }
    } catch (\Exception $e) {
      $this->messageManager->addErrorMessage($e->getMessage());
    }

    /** @var Redirect $redirect */
    $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

    return $redirect->setPath('*/*');
  }
}
