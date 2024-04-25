<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(
            'Caraque\PromoAdvanced\Model\PromoAdvancedEntity',
            'Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity'
        );
    }

    /**
     * @return $this
     */
    protected function _initSelect(): Collection
    {
        parent::_initSelect();

        $this->addFieldToSelect('name');
        $this->addFieldToSelect('store_id');

        return $this;
    }
}
