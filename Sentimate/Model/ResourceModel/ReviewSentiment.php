<?php

declare(strict_types=1);

namespace Caraque\Sentimate\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ReviewSentiment extends AbstractDb
{
    public const MAIN_TABLE = 'caraque_sentimate_review_sentiment';
    public const ID_FIELD_NAME = 'review_sentiment_id';

    /*
     * Initialize table.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
