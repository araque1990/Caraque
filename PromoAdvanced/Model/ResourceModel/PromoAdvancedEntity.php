<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;
use Caraque\PromoAdvanced\Model\PromoAdvancedEntity as ModelPromoAdvancedEntity;
use Magento\Eav\Model\Entity\Context;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;

class PromoAdvancedEntity extends AbstractEntity
{
  const MAIN_TABLE = 'promo_advanced_entity';
  const ID_FIELD_NAME = 'entity_id';


  public function __construct(
    Context $context,
    protected StoreManagerInterface $storeManager,
    protected ManagerInterface $eventManager,
    array $data = []
  ) {
    parent::__construct($context, $data);
    $this->setType(ModelPromoAdvancedEntity::ENTITY);
    $this->setConnection(ModelPromoAdvancedEntity::ENTITY . '_read', ModelPromoAdvancedEntity::ENTITY . '_write');
  }

  /**
   * Return Entity Type instance
   *
   * @return \Magento\Eav\Model\Entity\Type
   */
  public function getEntityType()
  {
    if (empty($this->_type)) {-
      $this->setType(ModelPromoAdvancedEntity::ENTITY);
    }
    return parent::getEntityType();
  }

  protected function _getDefaultAttributes()
    {
        return [
            'entity_id',
            'date_start',
            'date_end',
            'position',
            'status',
            'multiple_use'
        ];
    }

}
