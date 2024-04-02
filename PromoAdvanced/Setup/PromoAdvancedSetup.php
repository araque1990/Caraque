<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Caraque\PromoAdvanced\Model\PromoAdvancedEntity;
use Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity as ResourceModelPromoAdvancedEntity;

class PromoAdvancedSetup extends EavSetup
{

    public function getDefaultEntities()
    {
        return [
            PromoAdvancedEntity::ENTITY => [
                'entity_model' => ResourceModelPromoAdvancedEntity::class,
                'table' => 'promo_advanced_entity',
                'attributes' => [
                    'name' => [
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 7,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                    ],
                    'short_description' =>
                    [
                        'type' => 'varchar',
                        'label' => 'Short Description',
                        'input' => 'varchar',
                        'required' => false,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                    ],
                    'description' => [
                        'type' => 'text',
                        'label' => 'Descripción',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 8,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                    ],
                    'comment' =>
                    [
                        'type' => 'text',
                        'label' => 'Comment',
                        'input' => 'textarea',
                        'required' => false,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                    ]
                ]

            ]
        ];
    }
}
