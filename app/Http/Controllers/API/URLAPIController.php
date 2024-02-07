<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ShortenController;

class URLAPIController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        // Logic to generate short URL and save to database
        $baseURL = (new ShortenController)->shortenURL($request->input('original_url'));

        return response()->json([
            'success' => true,
            'message' => 'Short URL generated successfully.',
            'data' => [
                'short_url' => $baseURL, // Placeholder for the generated short URL
            ],
        ], 201);
    }

    public function getOriginalUrl($shortUrl)
    {
        $lastPath = basename(parse_url($shortUrl, PHP_URL_PATH));
        $baseURL = (new ShortenController)->redirectShortUrlLink($lastPath);

        // dd($baseURL);

        if ($baseURL) {
            return response()->json([
                'success' => true,
                'data' => [
                    'original_url' => $baseURL,
                ],
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Short URL not found.',
            ], 404);
        }
    }
}
