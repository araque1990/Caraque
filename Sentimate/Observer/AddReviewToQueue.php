<?php

declare(strict_types=1);

namespace Caraque\Sentimate\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\SerializerInterface;

class AddReviewToQueue implements ObserverInterface
{
    /**
     *  Constructor for event observer.
     *
     * @param PublisherInterface $publisher
     * @param SerializerInterface $serializer
     */
    public function __construct(
        private readonly PublisherInterface  $publisher,
        private readonly SerializerInterface $serializer
    )
    {
    }

    /**
     * Add a review to the queue
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(
        Observer $observer,
    ): void
    {
        $review = $observer->getEvent()->getData('object');

        if ($review->isObjectNew()) {
            // Add the logic to push message to the queue.
            $reviewData = $review->getData();
            $serializedReviewData = $this->serializer->serialize($reviewData);
            $this->publisher->publish('caraque.sentimate.reviews', $serializedReviewData);
        }
    }
}
