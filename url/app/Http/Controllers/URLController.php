<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ShortenController;

class URLController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        // Redirect to the shortened URL
        $baseURL = (new ShortenController)->shortenURL($request->input('original_url'));

        return redirect()->back()->with('success', $baseURL);
    }


    public function redirectShortUrl($shortUrl)
    {
        $baseURL = (new ShortenController)->redirectShortUrlLink($shortUrl);

        // Check if the URL record exists
        if ($baseURL) {
            // Redirect to the original URL
            return redirect($baseURL);
        } else {
            // Handle not found (404) or any other logic
            abort(404);
        }
    }
}
