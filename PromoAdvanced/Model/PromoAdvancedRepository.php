<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Model;

use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Caraque\PromoAdvanced\Api\Data\PromoAdvancedInterface;
use Caraque\PromoAdvanced\Api\Data\PromoAdvancedSearchResultsInterface;
use Caraque\PromoAdvanced\Api\Data\PromoAdvancedSearchResultsInterfaceFactory;
use Caraque\PromoAdvanced\Api\PromoAdvancedRepositoryInterface;
use Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity as PromoAdvancedEntityResource;
use Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity\CollectionFactory as PromoAdvancedEntityCollectionFactory;
use Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity\Collection;
use Caraque\PromoAdvanced\Model\PromoAdvancedEntityFactory;

class PromoAdvancedRepository implements PromoAdvancedRepositoryInterface
{
  const FIELDS_TO_SELECT = [
    PromoAdvancedInterface::ENTITY_ID,
    PromoAdvancedInterface::NAME,
    PromoAdvancedInterface::SHORT_DESCRIPTION,
    PromoAdvancedInterface::DESCRIPTION,
    PromoAdvancedInterface::DATE_START,
    PromoAdvancedInterface::DATE_END,
    PromoAdvancedInterface::POSITION,
    PromoAdvancedInterface::STATUS,
    PromoAdvancedInterface::COMMENT,
    PromoAdvancedInterface::MULTIPLE_USE
  ];
  public function __construct(
    private PromoAdvancedEntityFactory $promoAdvancedEntityFactory,
    private PromoAdvancedEntityResource $promoAdvancedEntityResource,
    private PromoAdvancedEntityCollectionFactory $promoAdvancedEntityCollectionFactory,
    protected ExtensibleDataObjectConverter $extensibleDataObjectConverter,
    protected JoinProcessorInterface $extensionAttributesJoinProcessor,
    private CollectionProcessorInterface $collectionProcessor,
    private PromoAdvancedSearchResultsInterfaceFactory $searchResultsFactory

  ) {
  }

    /**
   * {@inheritdoc}
   */
  public function save(PromoAdvancedInterface $promoAdvanced): PromoAdvancedInterface
  {
    $promoAdvancedData = $this->extensibleDataObjectConverter->toNestedArray(
      $promoAdvanced,
      [],
      PromoAdvancedInterface::class
    );

    $promoAdvancedModel = $this->promoAdvancedEntityFactory->create()->setData($promoAdvancedData);

    try {
      $this->promoAdvancedEntityResource->save($promoAdvancedModel);
    } catch (\Exception $exception) {
      throw new CouldNotSaveException(__(
        'Could not save the custom promo: %1',
        $exception->getMessage()
      ));
    }

    return $promoAdvancedModel;
  }

  /**
   * {@inheritdoc}
   */
  public function get($entityId): PromoAdvancedInterface
  {
    $promoAdvanced = $this->promoAdvancedEntityFactory->create();
    $this->promoAdvancedEntityResource->load($promoAdvanced, $entityId);

    if (!$promoAdvanced->getEntityId()) {
      throw new NoSuchEntityException(__('The promo with the "%1" ID doesn\'t exist', $entityId));
    }
    return $promoAdvanced->getDataModel();
  }

  public function getPromoAdvancedEntityCollection()
  {
    /** @var Collection $collection */
    $collection->addFieldToSelect(self::FIELDS_TO_SELECT);
    return $collection;
  }


  /**
   * {@inheritdoc}
   */
  public function getList(
    SearchCriteriaInterface $searchCriteria
  ): PromoAdvancedSearchResultsInterface {
    $collection = $this->promoAdvancedEntityCollectionFactory->create();

    $this->extensionAttributesJoinProcessor->process(
      $collection,
      PromoAdvancedInterface::class
    );

    $this->collectionProcessor->process($searchCriteria, $collection);

    $searchResults = $this->searchResultsFactory->create();
    $searchResults->setSearchCriteria($searchCriteria);

    $items = [];
    foreach ($collection as $model) {
      $items[] = $model->getDataModel();
    }

    $searchResults->setItems($items);
    $searchResults->setTotalCount($collection->getSize());
    return $searchResults;
  }

  public function delete(PromoAdvancedInterface $promoAdvanced): bool
  {
    try {
      $promoAdvancedModel = $this->promoAdvancedEntityFactory->create();
      $this->promoAdvancedEntityResource->load($promoAdvancedModel, $promoAdvanced->getEntityId());
      $this->promoAdvancedEntityResource->delete($promoAdvancedModel);
    } catch (\Exception $exception) {
      throw new CouldNotDeleteException(__(
        'Could not delete the promotion: %1',
        $exception->getMessage()
      ));
    }
    return true;
  }


  public function deleteById(int $entityId): bool
  {
    $promoAdvanced = $this->get($entityId);

    try {
      $this->promoAdvancedEntityResource->delete($promoAdvanced);
    } catch (\Exception $exception) {
      throw new CouldNotDeleteException(__($exception->getMessage()));
    }

    return true;
  }
}
