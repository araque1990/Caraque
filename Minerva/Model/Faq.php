<?php

declare(strict_types=1);

namespace Caraque\Minerva\Model;

use Caraque\Minerva\Model\ResourceModel\Faq as ResourceModelFaq;
use Magento\Framework\Model\AbstractModel;

class Faq extends AbstractModel
{
  protected function _construct()
  {
    $this->_init(ResourceModelFaq::class);
  }
}