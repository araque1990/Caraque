<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Caraque\PromoAdvanced\Model\PromoAdvancedEntity;
use Caraque\PromoAdvanced\Setup\PromoAdvancedSetupFactory;

class AddPromoAdvancedEavAttributes implements DataPatchInterface
{
  public function __construct(
    private ModuleDataSetupInterface $moduleDataSetup,
    private PromoAdvancedSetupFactory $promoAdvancedSetupFactory,
  ) {
  }

  /**
   * @inheritDoc
   */
  public static function getDependencies(): array
  {
    return [];
  }

  /**
   * Get aliases (previous names) for the patch.
   *
   * @return string[]
   */
  public function getAliases(): array
  {
    return [];
  }

  /**
   * Run code inside patch
   * If code fails, patch must be reverted, in case when we are speaking about schema - than under revert
   * means run PatchInterface::revert())
   *
   * @return $this
   */
  public function apply()
  {
    $this->moduleDataSetup->startSetup();
    /** @var $eavSetup EavSetup */
    $eavSetup = $this->promoAdvancedSetupFactory->create(['setup' => $this->moduleDataSetup]);
    $eavSetup->installEntities();
    $eavSetup->addAttribute(
      PromoAdvancedEntity::ENTITY,
      'name',
      [
        'type' => 'varchar',
        'label' => 'Name',
        'input' => 'text',
        'required' => true,
        'global' => ScopedAttributeInterface::SCOPE_STORE,
      ]
    );

    $eavSetup->addAttribute(
      PromoAdvancedEntity::ENTITY,
      'short_description',
      [
        'type' => 'varchar',
        'label' => 'Short Description',
        'input' => 'varchar',
        'required' => false,
        'global' => ScopedAttributeInterface::SCOPE_STORE,
      ]
    );

    $eavSetup->addAttribute(
      PromoAdvancedEntity::ENTITY,
      'description',
      [
        'type' => 'text',
        'label' => 'Description',
        'input' => 'textarea',
        'required' => false,
        'global' => ScopedAttributeInterface::SCOPE_STORE,
      ]
    );

    $eavSetup->addAttribute(
      PromoAdvancedEntity::ENTITY,
      'comment',
      [
        'type' => 'text',
        'label' => 'Comment',
        'input' => 'textarea',
        'required' => false,
        'global' => ScopedAttributeInterface::SCOPE_STORE,
      ]
    );
    
    $this->moduleDataSetup->endSetup();
  }
}
