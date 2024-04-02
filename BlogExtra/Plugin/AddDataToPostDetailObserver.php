<?php declare(strict_types=1);

namespace Caraque\BlogExtra\Plugin;

use Caraque\Blog\Observer\LogPostDetailView;
use Magento\Framework\Event\Observer;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class AddDataToPostDetailObserver
{
    public function __construct(
        private TimezoneInterface $timezone,
    ) {}

    public function beforeExecute(
        LogPostDetailView $subject,
        Observer $observer,
    ) {
        $request = $observer->getData('request');
        $request->setParam('datetime', $this->timezone->date());

        return [$observer];
    }
}
