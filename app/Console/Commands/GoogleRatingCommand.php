<?php

namespace App\Console\Commands;

use App\GoogleRating;
use App\Services\ApiService;
use Illuminate\Console\Command;
use Throwable;

class GoogleRatingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google-ratings:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Google Ratings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getGoogleRatings();
    }

    public function getGoogleRatings()
    {
        $headers    =  config('services.google_maps_headers');
        $token      =  config('services.google_maps_api_key');
        $url        =  config('services.google_maps_host_url');
        $api        =  new ApiService($url , $token , $headers);
        $places     =   config('services.google_maps_places');
        foreach($places as $place_id)
        {
            $params     =  [
                'place_id'   => $place_id,
                'key'        => 'AIzaSyD1XGJ3i2rN51ZrRC86aI6eXTysdqCloZA',
                'fields'        => 'name,reviews,rating',
            ];

            $response    = $api->get('place/details/json'  , $params);
            $reviews = @$response['result']['reviews'];
            foreach($reviews as $review)
            {
                try
                {
                    // Define a regular expression pattern to match special characters
                    $pattern = '/[^\p{L}\p{N}\s]/u';
                    // Replace special cahrs with empty string
                    $review['text'] =  preg_replace($pattern, '', $review['text']);
                    if(!GoogleRating::query()->whereAuthorName($review['author_name'])->first())
                    {
                        GoogleRating::query()->create($review);
                    }
                }catch(Throwable $e)
                {
                    info($review);
                }
            }
            info('REVIEWS COUNT: ' .GoogleRating::count());
        }
    }

}
