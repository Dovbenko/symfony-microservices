<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\ImageGenerationException;
use LLPhant\Image\Image;
use LLPhant\Image\OpenAIImage;
use LLPhant\OpenAIConfig;

/**
 * Service for generating images using OpenAI's DALL-E model.
 * 
 * This service extends the base AbstractGenerationService and provides
 * functionality to generate images from text prompts using the DALL-E API.
 * It handles API configuration, prompt validation, and error handling.
 */
class ImageGenerationService extends AbstractGenerationService
{
    /**
     * Generates an image from the given prompt
     *
     * @param string $prompt The text prompt to generate the image from
     * @return Image The URL of the generated image
     * @throws ImageGenerationException If the image generation fails
     */
    public function generateFromPrompt(string $prompt): Image
    {
        try {
            $config = $this->createConfig();
            $imageGenerator = $this->createImageGenerator($config);
            
            return $imageGenerator->generateImage($prompt);
        } catch (\Exception $e) {
            throw new ImageGenerationException(
                'Failed to generate image: ' . $e->getMessage()
            );
        }
    }

    /**
     * Creates an image generator instance
     *
     * @param OpenAIConfig $config The OpenAI configuration
     * @return OpenAIImage
     */
    private function createImageGenerator(OpenAIConfig $config): OpenAIImage
    {
        return new OpenAIImage($config);
    }
}
