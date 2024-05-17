<?php

declare(strict_types=1);

namespace Caraque\GraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class BlogResolver implements ResolverInterface
{

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        return [
            'title' => 'My awesome Blog',
            'store' => $context->getExtensionAttributes()->getStore()->getName(),
            'store_id' => $context->getExtensionAttributes()->getStore()->getId(),
            'current_customer_id' => $context->getUserId(),
            'user_type' => $context->getUserType(),
        ];
    }
}
