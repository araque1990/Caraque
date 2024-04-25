<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Model;

use Magento\Catalog\Model\ResourceModel\AbstractResource;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Api\ExtensionAttributesFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;
use Caraque\PromoAdvanced\Api\Data\PromoAdvancedInterface;
use Caraque\PromoAdvanced\Model\ResourceModel\PromoAdvancedEntity as ResourceModelPromoAdvancedEntity;

class PromoAdvancedEntity extends AbstractExtensibleModel implements PromoAdvancedInterface
{
    const ENTITY = 'promo_advanced_entity';
    const KEY_ENTITY_TYPE_ID = 'entity_type_id';
    const KEY_ATTR_TYPE_ID = 'attribute_set_id';
    const CACHE_TAG = 'promo_advance_entity';

    protected $_eventPrefix = 'promo_advanced_entity';
    protected $_idFieldName = 'entity_id';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModelPromoAdvancedEntity::class);
    }

    public function __construct(
        Context                         $context,
        Registry                        $registry,
        ExtensionAttributesFactory      $extensionAttributesFactory,
        AttributeValueFactory           $attributeValueFactory,
        protected StoreManagerInterface $storeManagerInterface,
        AbstractResource                $abstractResource = null,
        AbstractDb                      $abstractDb = null,
        array                           $data = [],
    )
    {
        parent::__construct(
            $context,
            $registry,
            $extensionAttributesFactory,
            $attributeValueFactory,
            $abstractResource,
            $abstractDb,
            $data
        );
        $this->_storeManager = $storeManagerInterface;
    }

    public function getEntityId(): ?int
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entityId): PromoAdvancedInterface
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    public function setName($name): PromoAdvancedInterface
    {
        return $this->setData(self::NAME, $name);
    }

    public function getShortDescription(): ?string
    {
        return $this->getData(self::SHORT_DESCRIPTION);
    }

    public function setShortDescription($shortDescription): PromoAdvancedInterface
    {
        return $this->setData(self::SHORT_DESCRIPTION, $shortDescription);
    }

    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function setDescription($description): PromoAdvancedInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function getDateStart(): ?string
    {
        return $this->getData(self::DATE_START);
    }

    public function setDateStart($dateStart): PromoAdvancedInterface
    {
        return $this->setData(self::DATE_START, $dateStart);
    }

    public function getDateEnd(): ?string
    {
        return $this->getData(self::DATE_END);
    }

    public function setDateEnd($dateEnd): PromoAdvancedInterface
    {
        return $this->setData(self::DATE_END, $dateEnd);
    }

    public function getPosition(): ?int
    {
        return $this->getData(self::POSITION);
    }

    public function setPosition($position): PromoAdvancedInterface
    {
        return $this->setData(self::POSITION, $position);
    }

    public function getStatus(): ?bool
    {
        $status = $this->getData((self::STATUS));
        if (!is_null($status)) {
            return boolval($status);
        }
        return null;
    }

    public function setStatus($status): PromoAdvancedInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    public function getComment(): ?string
    {
        return $this->getData(self::COMMENT);
    }

    public function setComment($comment): PromoAdvancedInterface
    {
        return $this->setData(self::COMMENT, $comment);
    }

    public function getMultipleUse(): ?bool
    {
        $multipleUse = $this->getData((self::MULTIPLE_USE));
        if (!is_null($multipleUse)) {
            return boolval($multipleUse);
        }
        return null;
    }

    public function setMultipleUse($multipleUse): PromoAdvancedInterface
    {
        return $this->setData(self::MULTIPLE_USE, $multipleUse);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Save from collection data
     *
     * @param array $data
     * @return $this|bool
     */
    public function saveCollection(array $data)
    {
        if (isset($data[$this->getId()])) {
            $this->addData($data[$this->getId()]);
            $this->ResourceModelPromoAdvancedEntity->save();
        }
        return $this;
    }

    /**
     * Set attribute set entity type id
     *
     * @param int $entityTypeId
     * @return $this
     */
    public function setEntityTypeId($entityTypeId)
    {
        return $this->setData(self::KEY_ENTITY_TYPE_ID, $entityTypeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityTypeId()
    {
        return $this->getData(self::KEY_ENTITY_TYPE_ID);
    }

    /**
     * Set attribute set id
     *
     * @param int $attrSetId
     * @return $this
     */
    public function setAttributeSetId($attrSetId)
    {
        return $this->setData(self::KEY_ATTR_TYPE_ID, $attrSetId);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeSetId()
    {
        return $this->getData(self::KEY_ATTR_TYPE_ID);
    }

    /**
     * Return store id.
     *
     * If store id is underfined for catalogue return current active store id
     *
     * @return int
     */
    public function getStoreId()
    {
        if ($this->hasData('store_id')) {
            return (int)$this->_getData('store_id');
        }
        return (int)$this->_storeManager->getStore()->getId();
    }

    /**
     * Set store id
     *
     * @param int|string $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        if (!is_numeric($storeId)) {
            $storeId = $this->_storeManager->getStore($storeId)->getId();
        }
        $this->setData('store_id', $storeId);
        $this->ResourceModelPromoAdvancedEntity->setStoreId($storeId);
        return $this;
    }
}
