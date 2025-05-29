<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\Prompt;
use App\Response\JsonResponse;
use App\Service\GenerationImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

/**
 * Controller responsible for handling image generation requests.
 * 
 * This controller provides an API endpoint for generating images from text prompts.
 * It handles request validation, error handling, and returns JSON responses with
 * either the generated image URL or appropriate error messages.
 */
class ImageController extends AbstractController
{
    /** @var string The expected content type for incoming requests */
    private const JSON_CONTENT_TYPE = 'json';

    /**
     * Generates an image from a text prompt.
     * 
     * This endpoint accepts a JSON request with a 'prompt' field containing the text description
     * of the image to generate. The prompt must be between 3 and 1000 characters long.
     * 
     * Example request:
     * ```json
     * {
     *     "prompt": "A serene landscape with mountains and a lake at sunset"
     * }
     * ```
     * 
     * Example success response:
     * ```json
     * {
     *     "status": "success",
     *     "data": {
     *         "image_url": "https://example.com/generated-image.jpg"
     *     }
     * }
     * ```
     * 
     * @param Prompt $prompt The validated prompt DTO containing the image description
     * @return JsonResponse A standardized JSON response containing either the generated image URL or an error message
     * 
     * @throws \Exception If image generation fails
     */
    #[Route('/api/generate-image', name: 'generate_image', methods: ['POST'], format: self::JSON_CONTENT_TYPE)]
    public function generateImage(
        #[MapRequestPayload] Prompt $prompt,
        GenerationImage $imageService
    ): JsonResponse
    {
        try {
            $imageUrl = $imageService->generateFromPrompt($prompt->prompt);
            
            return JsonResponse::success(['image_url' => $imageUrl]);
        } catch (\Exception $e) {
            return JsonResponse::error('Failed to generate image: ' . $e->getMessage());
        }
    }
}
 