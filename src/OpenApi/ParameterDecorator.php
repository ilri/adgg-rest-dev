<?php

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\OpenApi;

/**
 * @see https://api-platform.com/docs/core/openapi/#overriding-the-openapi-specification
 */
class ParameterDecorator implements OpenApiFactoryInterface
{
    /**
     * @var OpenApiFactoryInterface
     */
    private $decorated;

    /**
     * DocumentationDecorator constructor.
     * @param OpenApiFactoryInterface $decorated
     */
    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    /**
     * Retrieves openApi object paths and sets allowEmptyValue to false for all
     * GET operation parameters.
     *
     * @param array $context
     * @return OpenApi
     */
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        foreach ($openApi->getPaths()->getPaths() as $key => $path) {
            if($path->getGet()){
                $parameters = $path->getGet()->getParameters();

                foreach ($parameters as &$parameter) {
                    $parameter = $parameter->withAllowEmptyValue(false);
                }

                $getOperation = $path->getGet()->withParameters($parameters);
                $path = $path->withGet($getOperation);
                $openApi->getPaths()->addPath($key, $path);
            }
        }
        return $openApi;
    }
}
