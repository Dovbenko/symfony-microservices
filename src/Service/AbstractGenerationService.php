<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\OpenAIConfigurationException;
use LLPhant\OpenAIConfig;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Base service for generating content using OpenAI models.
 * 
 * This abstract class provides common functionality for services that
 * generate content using OpenAI models. It handles API configuration,
 * parameter management, and common error handling patterns.
 */
abstract class AbstractGenerationService implements GenerationServiceInterface
{
    /** @var string The default model to use for generation */
    protected const DEFAULT_MODEL = 'dall-e-3';

    /** @var string The environment variable name for the OpenAI API key */
    protected const OPENAI_API_KEY_PARAM = 'app.openai_api_key';

    /**
     * @param ParameterBagInterface $params Service for accessing application parameters and environment variables
     */
    public function __construct(
        protected readonly ParameterBagInterface $params
    ) {
    }

    /**
     * Creates and configures the OpenAI configuration
     *
     * This method creates a new OpenAI configuration instance and sets up
     * the necessary parameters for API access. It validates the API key
     * and throws an exception if it's not properly configured.
     *
     * @return OpenAIConfig
     * @throws OpenAIConfigurationException If the API key is not configured
     */
    public function createConfig(): OpenAIConfig
    {
        $apiKey = $this->params->get(self::OPENAI_API_KEY_PARAM);
        
        if (empty($apiKey)) {
            throw new OpenAIConfigurationException('OpenAI API key is not configured');
        }

        $config = new OpenAIConfig();
        $config->model = static::DEFAULT_MODEL;
        $config->apiKey = $apiKey;
        
        return $config;
    }
}