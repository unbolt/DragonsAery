<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {

        if($request->user()) {
            $is_admin = $request->user()->hasRole('admin');
            $active_character = $request->user()->activeCharacter()->with(['look', 'stats'])->first();
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'isAdmin' => $is_admin ?? false,
                'activeCharacter' => $active_character ?? false
            ],
        ]);
    }
}
