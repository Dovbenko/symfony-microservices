# Image Generation Microservice

A Symfony-based microservice for generating images from text prompts using OpenAI's DALL-E model.

## Features

- Generate images from text descriptions
- Input validation and error handling
- Standardized JSON response format
- Type-safe DTOs and responses
- RESTful API endpoint

## Requirements

- PHP 8.2 or higher
- Symfony 7.2
- OpenAI API key
- Composer

## Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd [repository-name]
```

2. Install dependencies:
```bash
composer install
```

3. Configure environment variables:

Edit `.env` and set your OpenAI API key:
```
APP_OPENAI_API_KEY=your_api_key_here
```

## API Documentation

### Generate Image

Generates an image from a text prompt using DALL-E.

**Endpoint:** `POST /api/generate-image`

**Content-Type:** `application/json`

**Request Body:**
```json
{
    "prompt": "A serene landscape with mountains and a lake at sunset"
}
```

**Success Response:**
```json
{
    "status": "success",
    "data": {
        "image_url": "https://example.com/generated-image.jpg"
    }
}
```

**Error Response:**
```json
{
    "status": "error",
    "message": "Error message here"
}
```

**Validation Rules:**
- Prompt must be between 3 and 1000 characters
- Prompt cannot be empty
- Content-Type must be application/json

## Project Structure

```
src/
├── Controller/
│   └── ImageController.php      # Handles image generation requests
├── DTO/
│   └── Prompt.php              # Data Transfer Object for prompts
├── Response/
│   └── JsonResponse.php        # Standardized JSON response format
└── Service/
    └── ImageGenerationService.php  # Handles image generation logic
```

## Error Handling

The service provides standardized error responses with appropriate HTTP status codes:
- 400 Bad Request: Invalid input or validation errors
- 500 Internal Server Error: Server-side errors or API failures

## Security

- API key is stored in environment variables
- Input validation to prevent malicious requests
- Content-Type validation
- Error messages are sanitized

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request