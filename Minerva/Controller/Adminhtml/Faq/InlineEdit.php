<?php declare(strict_types=1);

namespace Caraque\Minerva\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Caraque\Minerva\Model\Faq;
use Caraque\Minerva\Model\FaqFactory;
use Caraque\Minerva\Model\ResourceModel\Faq as FaqResource;

class InlineEdit extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Caraque_Minerva::faq_save';

    public function __construct(
        Context $context,
        protected JsonFactory $jsonFactory,
        protected FaqFactory $faqFactory,
        protected FaqResource $faqResource
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $json = $this->jsonFactory->create();
        $messages = [];
        $error = false;
        $isAjax = $this->getRequest()->getParam('isAjax', false);
        $items = $this->getRequest()->getParam('items', []);

        if (!$isAjax || !count($items)) {
            $messages[] = __('Please correct the data sent.');
            $error = true;
        }

        if (!$error) {
            foreach ($items as $item) {
                $id = $item['id'];
                try {
                    /** @var Faq $faq */
                    $faq = $this->faqFactory->create();
                    $this->faqResource->load($faq, $id);
                    $faq->setData(array_merge($faq->getData(), $item));
                    $this->faqResource->save($faq);
                } catch (\Exception $e) {
                    $messages[] = __("Something went wrong while saving item $id");
                    $error = true;
                }
            }
        }

        return $json->setData([
            'messages' => $messages,
            'error' => $error,
        ]);
    }
}