<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Caraque\PromoAdvanced\Api\PromoAdvancedRepositoryInterface;
use Caraque\PromoAdvanced\Model\PromoAdvancedEntityFactory;

class AddDataToPromoAdvancedTable implements DataPatchInterface
{
  /**
   * AddDataToPromoAdvancedTable constructor
   * @param ModuleDataSetupInterface $moduleDataSetup
   * @param PromoAdvancedEntityFactory $promoAdvancedEntityFactory
   * @param PromoAdvancedRepositoryInterface $promoAdvancedRepository
   */
  public function __construct(
    private ModuleDataSetupInterface $moduleDataSetup,
    private PromoAdvancedEntityFactory $promoAdvancedEntityFactory,
    private PromoAdvancedRepositoryInterface $promoAdvancedRepository,
  ) {
  }

  public static function getDependencies(): array
  {
    return [
      \Caraque\PromoAdvanced\Setup\Patch\Data\AddPromoAdvancedEavAttributes::class
    ];
  }

  public function getAliases(): array
  {
    return [];
  }

  /** Save Data to Eav Entity */
  public function apply(): void
  {
    $this->moduleDataSetup->startSetup();

    $promos = [
      [
        'name' => '3 + 1',
        'short_description' => 'Pay 3 get 4',
        'description' => 'If you buy 3 products, get another one totally free',
        'status' => 0,
        'date_start' => '2024-02-22',
        'date_end' => '2024-01-03',
        'comment' => 'This promotion will end it is for a limited time',
        'multiple_use' => 1,
      ],
      [
        'name' => '20% off',
        'short_description' => 'Minimun purchase 150$',
        'description' => 'From 150$ get a 20% discount',
        'status' => 0,
        'date_start' => '2024-02-22',
        'date_end' => '2024-04-01',
        'comment' => 'This offer does not include shipping price',
        'multiple_use' => 1,
      ],
      [
        'name' => '15% off on delicatessen',
        'short_description' => 'From 100$',
        'description' => 'From 100$ on charcuterie, get a 15% discount',
        'status' => 0,
        'date_start' => '2024-02-24',
        'date_end' => '2024-06-01',
        'comment' => 'This offer does not include shipping price',
        'multiple_use' => 0,
      ],
    ];

    foreach ($promos as $promoData) {
      $promo = $this->promoAdvancedEntityFactory->create();
      $promo->setData($promoData);
      $this->promoAdvancedRepository->save($promo);
    }

    $this->moduleDataSetup->endSetup();
  }
}
