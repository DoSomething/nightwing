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
        //created
        Redirect::created(function ($redirect) {
            Log::info(sprintf('Creating new Fastly redirect: %s => %s (%d)',
                $redirect->path, $redirect->target, $redirect->http_status));

            $fastly_key = config('services.fastly.key');
            $fastly_table_redirects = config('services.fastly.table_redirects');
            $fastly_table_redirect_types = config('services.fastly.table_redirect_types');
            $fastly_service_key = config('services.fastly.service_key');

            // Step one: Add to 'redirects' table.
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/dictionary/' . $fastly_table_redirects . '/item',
                CURLOPT_POSTFIELDS => [
                    'item_key' => $redirect->path,
                    'item_value' => $redirect->target,
                ],
            ]);
            $response = curl_exec($ch);

            Log::info(sprintf('Response: call 1: %s',
                $response));

            // Step two: Add to 'redirect_types' table.
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/dictionary/' . $fastly_table_redirect_types . '/item',
                CURLOPT_POSTFIELDS => [
                    'item_key' => $redirect->path,
                    'item_value' => $redirect->http_status,
                ],
            ]);
            $response = curl_exec($ch);

            Log::info(sprintf('Response: call 2: %s',
                $response));
        });

        //deleted
         Redirect::deleted(function ($redirect) {
             Log::info(sprintf('Deleting Fastly redirect: %s => %s (%d)',
                $redirect->path, $redirect->target, $redirect->http_status));

             $fastly_key = config('services.fastly.key');
             $fastly_table_redirects = config('services.fastly.table_redirects');
             $fastly_table_redirect_types = config('services.fastly.table_redirect_types');
             $fastly_service_key = config('services.fastly.service_key');

            // Step one: Remove from 'redirects' table.
            $ch = curl_init();
             curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/dictionary/' . $fastly_table_redirects . '/item/' . urlencode($redirect->path),
            ]);
             $response = curl_exec($ch);

             Log::info(sprintf('Response: call 1: %s',
                $response));

            // Step two: Remove from 'redirect_types' table.
            $ch = curl_init();
             curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/dictionary/' . $fastly_table_redirect_types . '/item/' . urlencode($redirect->path),
            ]);
             $response = curl_exec($ch);

             Log::info(sprintf('Response: call 2: %s',
                $response));

            // Step three: Purge this service so the deleted redirect stops working immediately
             $ch = curl_init();
             curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/purge_all',
             ]);
             $response = curl_exec($ch);

             Log::info(sprintf('Response: call 3 (purge): %s',
                $response));

         });

        //updated
         Redirect::updated(function ($redirect) {
             Log::info(sprintf('Updating existing Fastly redirect: %s => %s (%d)',
                $redirect->path, $redirect->target, $redirect->http_status));

             $fastly_key = config('services.fastly.key');
             $fastly_table_redirects = config('services.fastly.table_redirects');
             $fastly_table_redirect_types = config('services.fastly.table_redirect_types');
             $fastly_service_key = config('services.fastly.service_key');

            // Step one: Update 'redirects' table.
            $ch = curl_init();
             curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/dictionary/' . $fastly_table_redirects . '/item/' . urlencode($redirect->path),
                CURLOPT_POSTFIELDS => [
                    'item_value' => $redirect->target,
                ],
            ]);
             $response = curl_exec($ch);

             Log::info(sprintf('Response: call 1: %s',
                $response));

            // Step two: Update 'redirect_types' table.
            $ch = curl_init();
             curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/dictionary/' . $fastly_table_redirect_types . '/item/' . urlencode($redirect->path),
                CURLOPT_POSTFIELDS => [
                    'item_value' => $redirect->http_status,
                ],
            ]);
             $response = curl_exec($ch);

             Log::info(sprintf('Response: call 2: %s',
                $response));

            // Step three: Purge this service so the updated redirect target is immediately working
             $ch = curl_init();
             curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL => 'https://api.fastly.com/service/' . $fastly_service_key . '/purge_all',
            ]);
             $response = curl_exec($ch);

             Log::info(sprintf('Response: call 3 (purge): %s',
                $response));



         });
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
