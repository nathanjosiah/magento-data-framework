<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Framework\InputFilter;


/**
 *
 */
interface ResultInterface extends ValidationResultInterface
{
    /**
     * @return mixed
     */
    public function getResult();
}
