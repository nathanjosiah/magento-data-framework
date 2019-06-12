<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Framework;


use Magento\Framework\InputFilter\ContextInterface;
use Magento\Framework\InputFilter\ResultFactory;
use Magento\Framework\InputFilter\Transformer\ContextualFactoryInterface as TransformerFactory;
use Magento\Framework\InputFilter\Validator\ContextualFactoryInterface as ValidatorFactory;
use Magento\Framework\InputFilter\ResultInterface;

/**
 *
 */
class InputFilter implements InputFilterInterface
{
    /**
     * @var TransformerFactory
     */
    private $transformerFactory;

    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    /**
     * @var ContextInterface
     */
    private $defaultInputContext;

    /**
     * @var ContextInterface
     */
    private $defaultDesiredContext;

    /**
     * @var ResultFactory
     */
    private $resultFactory;

    /**
     * @param TransformerFactory $transformerFactory
     * @param ValidatorFactory $validatorFactory
     * @param ContextInterface $defaultInputContext
     * @param ContextInterface $defaultDesiredContext
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        TransformerFactory $transformerFactory,
        ValidatorFactory $validatorFactory,
        ContextInterface $defaultInputContext,
        ContextInterface $defaultDesiredContext,
        ResultFactory $resultFactory
    ) {
        $this->transformerFactory = $transformerFactory;
        $this->validatorFactory = $validatorFactory;
        $this->defaultInputContext = $defaultInputContext;
        $this->defaultDesiredContext = $defaultDesiredContext;
        $this->resultFactory = $resultFactory;
    }

    public function filter(
        $input,
        ?ContextInterface $inputContext = null,
        ?ContextInterface $desiredContext = null
    ): ResultInterface {
        $transformer = $this->transformerFactory->createFromContexts(
            $inputContext ?? $this->defaultInputContext,
            $desiredContext ?? $this->defaultDesiredContext
        );
        $validator = $this->validatorFactory->createFromContexts(
            $inputContext ?? $this->defaultInputContext,
            $desiredContext ?? $this->defaultDesiredContext
        );

        $data = $transformer->transform($input);
        $validationResult = $validator->validate($data);

        $result = $this->resultFactory->create([
            'isValid' => $validationResult->isValid(),
            'messages' => $validationResult->getMessages(),
            'result' => $data
        ]);

        return $result;
    }
}
