<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PromoAdvancedSearchResultsInterface extends SearchResultsInterface
{
  /**
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface[]
   */
  public function getItems();

  /**
   * @param \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterfacee[] $items
   * @return $this
   */
  public function setItems(array $items);
}