# OpenID Connect with Laravel login

## Requirements:
The authentication should be done using OpenID Connect(OIDC) Authorization Code Flow.

Use a clean Laravel installation to build an application that interacts with Keycloak and introspects the token(JWT) retrieved from the flow.

Store to Laravel default users table every user that logins.

The user journey needs to follow these steps:
1. User opens the application root(/) and gets a button "Login with Keycloak"
2. After successful login, the user is redirected back to the application home(/) a login session is generated and stored in the application.
3. The user should be able to see simple page showing the login session name and e-mail

## IdP(Keycloak) Credentials:

__IdP Endpoint__    : https://auth-demo.brainwave-software.com/realms/demorealm <br/>
__REALM__           : demorealm <br/>

__OIDC Client Credentials__ <br />
__Client ID__       : backend <br/>
__Client Secret__   : Z11U0KngwEobtqgRqMjNWnbkp6HyYqiJ

__User Credentials__ <br />
__Username__        : doda.lorenc@gmail.com <br/>
__Password__        : yeLAHB6x5YF1SLukoVxG2xjdqe4n64B <br/>
__Scope__           : openid profile <br/>

### Nice to have:
Describe each process(example: application setup, repository installation, etc.) can be documented in the `docs.md` file.

### Suggestions:
- Do not focus in the design(UI) of the application, but in its functionality

### Usefully links
<sup>1</sup>Introspect Endpoint https://auth-demo.brainwave-software.com/realms/demorealm/protocol/openid-connect/token/introspect

Keycloak documentation https://www.keycloak.org/docs/latest/securing_apps/