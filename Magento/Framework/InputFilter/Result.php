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
class Result implements ResultInterface
{
    /**
     * @var mixed
     */
    private $result;

    /**
     * @var bool
     */
    private $isValid;

    /**
     * @var array
     */
    private $messages;

    public function __construct(
        $result,
        bool $isValid,
        array $messages = []
    ) {

        $this->result = $result;
        $this->isValid = $isValid;
        $this->messages = $messages;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getMessages(): array
    {
        return $this->getMessages();
    }
}
