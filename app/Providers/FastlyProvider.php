<?php

namespace Nightwing\Providers;

use Illuminate\Support\ServiceProvider;

use Nightwing\Models\Redirect;
use Log;

class FastlyProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Redirect::created(function($redirect) {
            Log::info(sprintf('Creating new Fastly redirect: %s => %s (%d)',
                $redirect->path, $redirect->target, $redirect->http_status));


            // Here's the hacky part....
            $fastly_key = '30342701a122f58e935c9fe1024b8bc8';
            $fastly_table_redirects = 'isbuug15ZlBduv6XWk0VU';
            $fastly_table_redirect_types = '5v35JNHgaK2qFG5fNacSPO';

            // Step one: Add to 'redirects' table.
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_HTTPHEADER => array(sprintf('Fastly-Key: %s', $fastly_key)),
                CURLOPT_URL => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/' . $fastly_table_redirects . '/item',
                CURLOPT_POSTFIELDS => array(
                    'item_key' => $redirect->path,
                    'item_value' => $redirect->target,
                ),
            ));
            $response = curl_exec($ch);

            Log::info(sprintf('Response: call 1: %s',
                $response));

            // Step two: Add to 'redirect_types' table.
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_HTTPHEADER => array(sprintf('Fastly-Key: %s', $fastly_key)),
                CURLOPT_URL => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/' . $fastly_table_redirect_types . '/item',
                CURLOPT_POSTFIELDS => array(
                    'item_key' => $redirect->path,
                    'item_value' => $redirect->http_status,
                ),
            ));
            $response = curl_exec($ch);

            Log::info(sprintf('Response: call 2: %s',
                $response));

        });

        //deleted

        //updated
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
