<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 * ArtisanController
 * Provides methods for executing Artisan commands via API calls
 * @authro Ronald Lee <ronald@ronaldlee.co.uk>
 */
class ArtisanController extends Controller
{
    /**
     * Seeds the database with premade data
     */
    public function db_seed()
    {
        Artisan::call('db:seed');
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Clears the cache
     */
    public function cache_clear()
    {
        Artisan::call('cache:clear');
        return response()->json([
            'status' => 'success',
        ]);
    }
}
