<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Api;

use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Caraque\PromoAdvanced\Api\Data\PromoAdvancedInterface;
use Caraque\PromoAdvanced\Api\Data\PromoAdvancedSearchResultsInterface;

/**
 * PromoAdvanced for custom promo CRUD interface.
 * @api
 * @since 1.0.0
 */

interface PromoAdvancedRepositoryInterface
{

  /**
   * Save PromoAdvanced
   * @param \Caraque\PromoAdvanced\Api\Data\PromoAdvancedInterface $promoAdvanced
   * @return \Caraque\PromoAdvanced\Api\Data\PromoAdvancedInterface
   * @throws \Magento\Framework\Exception\LocalizedException
   */
  public function save(PromoAdvancedInterface $promoAdvanced): PromoAdvancedInterface;

  /**
   * Retrieve PromoAdvanced
   * @param integer $entityId
   * @return \Caraque\PromoAdvanced\Api\Data\PromoAdvancedInterface
   * @throws \Magento\Framework\Exception\LocalizedException
   */
  public function get(int $entityId): PromoAdvancedInterface;

  /**
   * Retrieve PromoAdvanced matching the specified criteria.
   *
   * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
   * @return \Caraque\PromoAdvanced\Api\Data\PromoAdvancedSearchResultsInterface
   * @throws \Magento\Framework\Exception\LocalizedException
   */
  public function getList(SearchCriteriaInterface $searchCriteria): PromoAdvancedSearchResultsInterface;


  /**
   * Delete PromoAdvanced
   *
   * @param \Caraque\PromoAdvanced\Api\Data\PromoAdvancedInterface $promoAdvanced
   * @return bool true on success
   * @throws \Magento\Framework\Exception\LocalizedException
   */
  public function delete(PromoAdvancedInterface $promoAdvanced): bool;

  /**
   * Delete PromoAdvanced By Id
   *
   * @param integer $entityId
   * @return boolean true on success
   * @throws \Magento\Framework\Exception\LocalizedException
   * @throws \Magento\Framework\Exception\NoSuchEntityException
   */
  public function deleteById(int $entityId): bool;
}
