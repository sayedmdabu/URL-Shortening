<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\ClickStatistic;

class URLController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortUrl = $this->generateShortUrl();

        $url = new Url([
            'original_url' => $request->input('original_url'),
            'short_url' => $shortUrl,
        ]);

        $url->save();

        // Redirect to the shortened URL
        $baseURL = url('/') .'/base/' . $shortUrl;

        return redirect()->back()->with('success', $baseURL);
    }

    private function generateShortUrl()
    {
        // Generate short URL logic here (e.g., using a hash)
        return substr(md5(uniqid()), 0, 8);
    }

    public function redirectShortUrl($shortUrl)
    {
        // Find the URL record with the given short URL
        $url = URL::where('short_url', $shortUrl)->first();

        // Check if the URL record exists
        if ($url) {
            // Create a new click statistic record
            $clickStatistic = new ClickStatistic([
                'url_id' => $url->id,
                'clicked_at' => now(),
            ]);
            $clickStatistic->save();
            
            // Redirect to the original URL
            return redirect($url->original_url);
        } else {
            // Handle not found (404) or any other logic
            abort(404);
        }
    }
}
