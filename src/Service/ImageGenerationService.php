<?php declare(strict_types=1);

namespace App\Service;

use LLPhant\Image\Image;
use LLPhant\Image\OpenAIImage;
use LLPhant\OpenAIConfig;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

/**
 * Service for generating images using OpenAI's DALL-E model.
 * 
 * This service implements the ImageGenerationServiceInterface and provides
 * functionality to generate images from text prompts using the DALL-E API.
 * It handles API configuration, prompt validation, and error handling.
 */
class ImageGenerationService
{
    /** @var string The default model to use for image generation */
    private const DEFAULT_MODEL = 'dall-e-3';

    /**
     * @param ParameterBagInterface $params Service for accessing application parameters and environment variables
     */
    public function __construct(
        private readonly ParameterBagInterface $params
    ) {
    }

    /**
     * Generates an image from the given prompt
     *
     * @param string $prompt The text prompt to generate the image from
     * @return Image The URL of the generated image
     * @throws \InvalidArgumentException If the prompt is invalid
     * @throws ServiceUnavailableHttpException If the image generation fails
     */
    public function generateImageFromPrompt(string $prompt): Image
    {
        try {
            $config = $this->createOpenAIConfig();
            $imageGenerator = new OpenAIImage($config);
            
            return $imageGenerator->generateImage($prompt);
        } catch (\Exception $e) {
            throw new ServiceUnavailableHttpException(
                null,
                'Failed to generate image: ' . $e->getMessage(),
                $e
            );
        }
    }

    /**
     * Creates and configures the OpenAI configuration
     *
     * @return OpenAIConfig
     * @throws \RuntimeException If the API key is not configured
     */
    private function createOpenAIConfig(): OpenAIConfig
    {
        $apiKey = $this->params->get('app.openai_api_key');
        
        if (empty($apiKey)) {
            throw new \RuntimeException('OpenAI API key is not configured');
        }

        $config = new OpenAIConfig();
        $config->model = self::DEFAULT_MODEL;
        $config->apiKey = $apiKey;
        
        return $config;
    }
}
