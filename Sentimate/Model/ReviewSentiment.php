<?php

declare(strict_types=1);

namespace Caraque\Sentimate\Model;

use Magento\Framework\Model\AbstractModel;
use Caraque\Sentimate\Model\ResourceModel\ReviewSentiment as ResourceModel;

class ReviewSentiment extends AbstractModel
{
    /**
     * Primary id.
     *
     * @var string $_idFieldName
     */

    protected $_idFieldName = ResourceModel::ID_FIELD_NAME;

    /**
     * Initialize with resource model.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel::class);
    }
}
