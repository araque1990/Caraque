<?php

declare(strict_types=1);

namespace Caraque\Minerva\Model\ResourceModel\Faq;

use Caraque\Minerva\Model\Faq;
use Caraque\Minerva\Model\ResourceModel\Faq as ResourceModelFaq;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
  protected function _construct()
  {
    $this->_init(Faq::class, ResourceModelFaq::class);
  }
}