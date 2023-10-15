<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AuthService
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|RedirectResponse|Redirector
     */
    public function redirectToProvider()
    {
        $query = http_build_query([
            'client_id' => env('OIDC_CLIENT_ID'),
            'redirect_uri' => env('REDIRECT_URI'),
            'response_type' => 'code',
            'scope' => 'openid profile',
        ]);

        return redirect(env('BRAINWAVE_OIDC_REDIRECT'). '?' . $query);
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function handleProviderCallback()
    {
        $response = Http::asForm()->post(env('BRAINWAVE_OIDC_URL'), [
            'grant_type' => 'authorization_code',
            'client_id' => env('OIDC_CLIENT_ID'),
            'client_secret' => env('OIDC_CLIENT_SECRET'),
            'redirect_uri' => env('REDIRECT_URI'),
            'code' => request('code'),
        ])->json();

        $tokenDetails = $this->introspectToken($response['access_token']);

        if (!$tokenDetails['active']) {
            // Token is not active
            return redirect('/')->withErrors(['token' => 'The token is not active.']);
        }

        $oidcUser = Http::withToken($response['access_token'])->get('https://auth-demo.brainwave-software.com/realms/demorealm/protocol/openid-connect/userinfo')->json();

        $user = User::firstOrCreate(
            ['email' => $oidcUser['email']],
            [
                'name' => $oidcUser['name'] ?? $oidcUser['preferred_username'],
                'email_verified_at' => now()
            ]
        );

        //User login
        Auth::login($user, true);

        // Return user object.
        return $user;
    }

    /**
     * @param $accessToken
     * @return array|mixed
     */
    public function introspectToken($accessToken)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('OIDC_CLIENT_ID') . ':' . env('OIDC_CLIENT_SECRET')),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post(env('BRAINWAVE_OIDC_INTROSPECT'), [
            'token' => $accessToken,
            'token_type_hint' => 'access_token',
        ]);

        return $response->json();
    }

}
