<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Caraque\PromoAdvanced\Model\PromoAdvancedEntity;
use Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity as ResourceModelPromoAdvancedEntity;

class Collection extends AbstractCollection
{
  protected function _construct()
  {
    $this->_init(PromoAdvancedEntity::class, ResourceModelPromoAdvancedEntity::class);
  }
}