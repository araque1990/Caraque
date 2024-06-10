<?php

declare(strict_types=1);

namespace Caraque\JsFun\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Message implements ArgumentInterface
{
    public function getMessage()
    {
        return __(str_shuffle('Declarative test'));
    }
}
