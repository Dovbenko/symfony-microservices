<?php declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Data Transfer Object for image generation prompts.
 * 
 * This class represents the data structure for image generation requests
 * and includes validation rules for the prompt field.
 */
class Prompt
{
    /** @var int The minimum allowed length for a prompt */
    private const MIN_PROMPT_LENGTH = 3;

    /** @var int The maximum allowed length for a prompt */
    private const MAX_PROMPT_LENGTH = 1000;

    public function __construct(
        #[SerializedName('prompt')]
        #[Assert\NotBlank(message: "Prompt cannot be empty")]
        #[Assert\Length(
            min: self::MIN_PROMPT_LENGTH,
            max: self::MAX_PROMPT_LENGTH,
            minMessage: "Prompt must be at least {{ limit }} characters long",
            maxMessage: "Prompt must not exceed {{ limit }} characters"
        )]
        public string $prompt
    ) {
    }
} 