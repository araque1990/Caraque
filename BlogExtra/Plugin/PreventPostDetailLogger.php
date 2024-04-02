<?php declare(strict_types=1);

namespace Caraque\BlogExtra\Plugin;

use Caraque\Blog\Observer\LogPostDetailView;

class PreventPostDetailLogger
{
    public function aroundExecute(
        LogPostDetailView $subject,
        callable $proceed,
    ) {
        // Don't do anything to prevent logger from executing
    }
}
