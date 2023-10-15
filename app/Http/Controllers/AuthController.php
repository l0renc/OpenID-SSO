<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;


class AuthController extends Controller
{
    protected $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function redirectToProvider()
    {
        return $this->authService->redirectToProvider();
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function handleProviderCallback()
    {
        $this->authService->handleProviderCallback();
        return redirect('/home');
    }

    /**
     * @return Application|Factory|View
     */
    public function home()
    {
        $user = session('user');

        return view('home', compact('user'));
    }
}
