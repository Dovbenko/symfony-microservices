<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\ChatGenerationException;
use LLPhant\Chat\OpenAIChat;
use LLPhant\OpenAIConfig;

/**
 * Service for generating chat responses using OpenAI's GPT model.
 * 
 * This service extends the base AbstractGeneration and provides
 * functionality to generate chat responses from prompts using the GPT API.
 * It handles API configuration, prompt validation, and error handling.
 */
class GenerationChat extends AbstractGeneration
{
    /** @var string The default model to use for chat generation */
    protected const DEFAULT_MODEL = 'gpt-4';

    /**
     * Generates a chat response from the given prompt
     *
     * @param string $prompt The text prompt to generate a chat response from
     * @return string The generated chat response
     * @throws ChatGenerationException If the chat generation fails
     */
    public function generateFromPrompt(string $prompt): string
    {
        try {
            $config = $this->createConfig();
            $chatGenerator = $this->createChatGenerator($config);
            
            return $chatGenerator->generateText($prompt);
        } catch (\Exception $e) {
            throw new ChatGenerationException(
                'Failed to generate chat response: ' . $e->getMessage()
            );
        }
    }

    /**
     * Creates a chat generator instance
     *
     * @param OpenAIConfig $config The OpenAI configuration
     * @return OpenAIChat
     */
    private function createChatGenerator(OpenAIConfig $config): OpenAIChat
    {
        return new OpenAIChat($config);
    }
} 