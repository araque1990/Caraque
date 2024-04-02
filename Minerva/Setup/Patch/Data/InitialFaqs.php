<?php

declare(strict_types=1);

namespace Caraque\Minerva\Setup\Patch\Data;

use Caraque\Minerva\Model\ResourceModel\Faq;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class InitialFaqs implements DataPatchInterface
{
  /**
   * InitialFaqs constructor.
   * @param ModuleDataSetupInterface $moduleDataSetupInterface
   * @param ResourceConnection $resourceConnection
   */
  public function __construct(
    protected ModuleDataSetupInterface $moduleDataSetupInterface,
    protected ResourceConnection $resourceConnection
  ) { }

  public static function getDependencies(): array
  {
    return [];
  }

  public function getAliases(): array
  {
    return [];
  }

  public function apply(): self
  {
    $connection = $this->resourceConnection->getConnection();
    $data = [
      [
        'question' => 'What is your best selling item?',
        'answer' => 'The item you buy',
        'is_published' => 1,
      ],
      [
        'question' => 'What is your customer support number?',
        'answer' => '212-867-5309. Ask for Jenny!',
        'is_published' => 1,
      ],
      [
        'question' => 'When will I get my order?',
        'answer' => 'When it gets delivered, silly!',
        'is_published' => 0,
      ],
    ];

    $connection->insertMultiple(Faq::MAIN_TABLE, $data);
    
    return $this;
  }
}