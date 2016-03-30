<?php

namespace Nightwing\Providers;

use Illuminate\Support\ServiceProvider;
use Log;
use Nightwing\Models\Redirect;

class FastlyProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Redirect::created(function ($redirect) {
            Log::info(sprintf('Creating new Fastly redirect: %s => %s (%d)',
                $redirect->path, $redirect->target, $redirect->http_status));

            $fastly_key = config('services.fastly.key');
            $fastly_table_redirects = config('services.fastly.table_redirects');
            $fastly_table_redirect_types = config('services.fastly.table_redirect_types');

            // Step one: Add to 'redirects' table.
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST           => 1,
                CURLOPT_HTTPHEADER     => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL            => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/'.$fastly_table_redirects.'/item',
                CURLOPT_POSTFIELDS     => [
                    'item_key'   => $redirect->path,
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
                CURLOPT_POST           => 1,
                CURLOPT_HTTPHEADER     => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL            => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/'.$fastly_table_redirect_types.'/item',
                CURLOPT_POSTFIELDS     => [
                    'item_key'   => $redirect->path,
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

            // Step one: Remove from 'redirects' table.
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST  => 'DELETE',
                CURLOPT_HTTPHEADER     => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL            => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/'.$fastly_table_redirects.'/item/'.urlencode($redirect->path),
            ]);
            $response = curl_exec($ch);

            Log::info(sprintf('Response: call 1: %s',
                $response));

            // Step two: Remove from 'redirect_types' table.
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST  => 'DELETE',
                CURLOPT_HTTPHEADER     => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL            => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/'.$fastly_table_redirect_types.'/item/'.urlencode($redirect->path),
            ]);
            $response = curl_exec($ch);

            Log::info(sprintf('Response: call 2: %s',
                $response));

        });

        //updated
         Redirect::updated(function ($redirect) {
            Log::info(sprintf('Updating existing Fastly redirect: %s => %s (%d)',
                $redirect->path, $redirect->target, $redirect->http_status));

            $fastly_key = config('services.fastly.key');
            $fastly_table_redirects = config('services.fastly.table_redirects');
            $fastly_table_redirect_types = config('services.fastly.table_redirect_types');

            // Step one: Update 'redirects' table.
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST  => 'PUT',
                CURLOPT_HTTPHEADER     => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL            => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/'.$fastly_table_redirects.'/item/'.urlencode($redirect->path),
                CURLOPT_POSTFIELDS     => [
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
                CURLOPT_CUSTOMREQUEST  => 'PUT',
                CURLOPT_HTTPHEADER     => [sprintf('Fastly-Key: %s', $fastly_key)],
                CURLOPT_URL            => 'https://api.fastly.com/service/3uoN6UPm3Byl5RAkYuhTTk/dictionary/'.$fastly_table_redirect_types.'/item/'.urlencode($redirect->path),
                CURLOPT_POSTFIELDS     => [
                    'item_value' => $redirect->http_status,
                ],
            ]);
            $response = curl_exec($ch);

            Log::info(sprintf('Response: call 2: %s',
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
