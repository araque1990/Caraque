<?php

declare(strict_types=1);

namespace Caraque\PromoAdvanced\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface PromoAdvancedInterface extends ExtensibleDataInterface
{
  public const ENTITY_ID = 'entity_id';
  public const NAME = 'name';
  public const SHORT_DESCRIPTION = 'short_description';
  public const DESCRIPTION = 'description';
  public const DATE_START = 'date_start';
  public const DATE_END = 'date_end';
  public const POSITION = 'position';
  public const STATUS = 'status';
  public const COMMENT = 'comment';
  public const MULTIPLE_USE = 'multiple_use';

  /**
   * @return integer|null
   */
  public function getEntityId(): ?int;

  /**
   * @param int $entityId
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setEntityId($entityId): PromoAdvancedInterface;

  /**
   * @return string|null
   */
  public function getName(): ?string;

  /**
   * @param string $name
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setName($name): PromoAdvancedInterface;

  /**
   * @return string|null
   */
  public function getShortDescription(): ?string;

  /**
   * @param string $shortDescription
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setShortDescription($shortDescription): PromoAdvancedInterface;

  /**
   * @return string|null
   */
  public function getDescription(): ?string;

  /**
   * @param string $description
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setDescription($description): PromoAdvancedInterface;

  /**
   * @return string|null
   */
  public function getDateStart(): ?string;

  /**
   * @param string $dateStart
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setDateStart($dateStart): PromoAdvancedInterface;

  /**
   * @return string|null
   */
  public function getDateEnd(): ?string;

  /**
   * @param string $dateEnd
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setDateEnd($dateEnd): PromoAdvancedInterface;

  /**
   * @return integer|null
   */
  public function getPosition(): ?int;

  /**
   * @param int $position
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setPosition($position): PromoAdvancedInterface;

  /**
   * @return boolean|null
   */
  public function getStatus(): ?bool;

  /**
   * @param bool $status
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setStatus($status): PromoAdvancedInterface;

  /**
   * @return string|null
   */
  public function getComment(): ?string;

  /**
   * @param string $comment
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setComment($comment): PromoAdvancedInterface;

  /**
   * @return boolean|null
   */
  public function getMultipleUse(): ?bool;

  /**
   * @param bool $multipleUse
   * @return \NttData\PromoAdvanced\Api\Data\PromoAdvancedInterface
   */
  public function setMultipleUse($multipleUse): PromoAdvancedInterface;

}