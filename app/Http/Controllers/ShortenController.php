<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Url;
use App\Models\ClickStatistic;

class ShortenController extends Controller
{
    public function shortenURL($original_url)
    {
        $shortUrl = $this->generateShortUrl();

        $url = new Url([
            'original_url' => $original_url,
            'short_url' => $shortUrl,
        ]);

        $url->save();

        // Redirect to the shortened URL
        $baseURL = url('/') .'/base/' . $shortUrl;

        return $baseURL;
    }


    private function generateShortUrl()
    {
        // Generate short URL logic here (e.g., using a hash)
        return substr(md5(Carbon::now()->timestamp), 0, 8);
    }


    public function redirectShortUrlLink($shortUrl)
    {
        // Find the URL record with the given short URL
        $url = Url::where('short_url', $shortUrl)->first();

        // Check if the URL record exists
        if ($url) {
            // Create a new click statistic record
            $clickStatistic = new ClickStatistic([
                'url_id' => $url->id,
                'clicked_at' => now(),
            ]);
            $clickStatistic->save();
            
            // Redirect to the original URL
            return $url->original_url;
        } else {
            // Handle not found (404) or any other logic
            abort(404);
        }
    }
}
