# Brainwave OpenID Connect with Laravel login

## Overview
This documentation provides an overview of the Brainwave OIDC (OpenID Connect) authentication implementation in our Laravel application. It explains the primary classes and methods used to accomplish user authentication via OIDC and how user data is managed post-authentication.

## 1. AuthController
The `AuthController` is responsible for managing the user's authentication flow. It has the following key methods:

- **redirectToProvider()**:
    - Redirects the user to the Brainwave OIDC authentication page.
    - Constructs the redirect URL with necessary parameters such as `client_id`, `redirect_uri`, `response_type`, and `scope`.

- **handleProviderCallback()**:
    - Handles the callback from the OIDC provider after a user has attempted authentication.
    - The user's authentication code is exchanged for an access token.
    - The access token's validity is checked, and user details are fetched.
    - If valid, the user is stored in the local database and then authenticated for the application.
    - Redirects to the home page post successful authentication.

- **home()**:
    - Returns the authenticated user's home view.

## 2. AuthService
This service class encapsulates the logic related to the OIDC authentication process:

- **redirectToProvider()**:
    - Assembles and returns the redirect URL to the OIDC provider's authentication page.

- **handleProviderCallback()**:
    - Validates the access token received from the OIDC provider.
    - Fetches the authenticated user's details.
    - Saves the user to the local database, if not already present.
    - Authenticates the user for the application.

- **introspectToken($accessToken)**:
    - Introspects the access token to verify its validity.
    - Returns the introspected token details.

## 3. User Entity
The `User` model represents the application's users. After authentication via OIDC, the user's details, like email and name, are saved to the local database. If a user with a given email does not exist, a new record is created. Otherwise, the existing user is authenticated.

## Environment Variables
Several environment variables are used to keep sensitive information out of the codebase:

- **OIDC_CLIENT_ID**: The client ID for OIDC authentication.
- **OIDC_CLIENT_SECRET**: The secret key associated with the client ID.
- **REDIRECT_URI**: The URI where the OIDC provider will send the authentication code.
- **BRAINWAVE_OIDC_REDIRECT**: The OIDC provider's URL for initiating the authentication process.
- **BRAINWAVE_OIDC_URL**: The OIDC provider's URL for exchanging the authentication code for an access token.


## Setup

1.Clone the repository

`git clone git@github.com:l0renc/OpenID-SSO.git`

2.Install Dependencies:

`composer install`

3.Environment Configuration:

`cp .env.example .env`

4.Database Migrations

`php artisan migrate`

5.Start the Application

`php artisan serve`
