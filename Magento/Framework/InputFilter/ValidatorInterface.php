<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Framework;

use Magento\Framework\InputFilter\ResultInterface;

/**
 *
 */
interface ValidatorInterface
{
    public function validate($data): ResultInterface;
}
