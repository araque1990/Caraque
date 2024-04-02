<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity\Grid;

use Caraque\PromoAdvanced\Model\PromoAdvancedRepository;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _construct(): void
    {
        $this->_init(
            'Caraque\PromoAdvanced\Model\PromoAdvancedEntity',
            'Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity'
        );
    }
}