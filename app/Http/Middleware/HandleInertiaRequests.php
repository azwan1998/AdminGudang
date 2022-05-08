<?php

namespace App\Http\Middleware;

// use App\Models\Out;

use App\Models\Kategori;
use App\Models\Stock;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return array_merge(parent::share($request), [
            'permission' => function () use ($user) {
                if (!$user) {
                    return;
                }

                return [
                    'users' => [
                        'create' => $user->can('create', User::class),
                        'viewAny' => $user->can('viewAny', User::class),
                        'editRole' => $user->checkRole('admin'),
                    ],
                    'posts' => [
                        'create' => $user->can('create', Post::class),
                        'viewAny' => $user->can('viewAny', User::class),
                    ],
                    'incomings' => [
                        'create' => $user->can('create', Incoming::class),
                        'viewAny' => $user->can('viewAny', User::class),
                    ],
                    'stocks' => [
                        'create' => $user->can('create', Stock::class),
                        'viewAny' => $user->can('viewAny', User::class),
                    ],
                    'outs' => [
                        'create' => $user->can('create', Out::class),
                        'viewAny' => $user->can('viewAny', User::class),
                    ],
                    'kategoris' => [
                        'create' => $user->can('create', Kategori::class),
                        'viewAny' => $user->can('viewAny', User::class),
                    ],
                ];
            },
        ]);
    }
}
