<?php

// src/Controller/WebhookController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebhookController
{
    /**
     * @Route("/webhook/upload", name="webhook_upload", methods={"POST"})
     */
    public function handleImageUpload(Request $request): JsonResponse
    {
        // Handle image upload logic here

        // Access uploaded files
        $files = $request->files->all();

        // Process each uploaded file
        foreach ($files as $file) {
            // Handle the uploaded file, e.g., move it to a specific directory
            $file->move('/Users/mirierimogaka/Downloads/rest_api/adgg-zoetis-api/public/images', $file->getClientOriginalName());
        }

        // You may want to perform additional processing or validation here

        // Respond with a JSON response
        return new JsonResponse(['message' => 'Image(s) uploaded successfully'], Response::HTTP_OK);
    }
}
