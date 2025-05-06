<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\ImageGenerationException;
use App\Exception\OpenAIConfigurationException;
use LLPhant\OpenAIConfig;

/**
 * Interface for generation services that create content using AI models.
 * 
 * This interface defines the contract for services that generate content
 * using various AI models. It provides a standardized way to implement
 * different types of generation services while maintaining consistent
 * error handling and response formats.
 * 
 */
interface GenerationServiceInterface
{
    /**
     * Generates content from the given prompt
     *
     * This method takes a text prompt and uses it to generate content
     * using the configured AI model. The implementation should handle
     * all necessary validation, configuration, and error handling.
     *
     * @param string $prompt The text prompt to generate content from
     * @return The generated content
     * @throws ImageGenerationException If the prompt is invalid
     */
    public function generateFromPrompt(string $prompt): mixed;

    /**
     * Creates and configures the OpenAI configuration
     *
     * This method creates a new OpenAI configuration instance and sets up
     * the necessary parameters for API access. It validates the API key
     * and throws an exception if it's not properly configured.
     *
     * @return OpenAIConfig The configured OpenAI configuration instance
     * @throws OpenAIConfigurationException If the API key is not configured or invalid
     */
    public function createConfig(): OpenAIConfig;
}
