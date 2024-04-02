<?php

declare(strict_types=1);

namespace Caraque\Minerva\Controller\Adminhtml\Faq;

use Caraque\Minerva\Model\ResourceModel\Faq as FaqResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Caraque\Minerva\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action implements HttpPostActionInterface
{
  const ADMIN_RESOURCE = 'Caraque_Minerva::faq_delete';

  public function __construct(
    Context $context,
    protected CollectionFactory $collectionFactory,
    protected Filter $filter,
    protected FaqResource $faqResource
  ) {
    parent::__construct($context);
  }

  public function execute(): Redirect
  {
    $collection = $this->collectionFactory->create();
    $items = $this->filter->getCollection($collection);
    $itemsSize = $items->getSize();

    foreach ($items as $item) {
      $this->faqResource->delete($item);
    }

    $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $itemsSize));

    /** @var Redirect $redirect */
    $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

    return $redirect->setPath('*/*');
  }
}
