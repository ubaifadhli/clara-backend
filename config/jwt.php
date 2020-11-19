<?php
    return [
        /*
        |--------------------------------------------------------------------------
        | JWT time to live
        |--------------------------------------------------------------------------
        |
        | Specify the length of time (in minutes) that the token will be valid for.
        | Defaults to 1 hour.
        |
        | You can also set this to null, to yield a never expiring token.
        | Some people may want this behaviour for e.g. a mobile app.
        | This is not particularly recommended, so make sure you have appropriate
        | systems in place to revoke the token if necessary.
        | Notice: If you set this to null you should remove 'exp' element from 'required_claims' list.
        |
        */

        'ttl' => env('JWT_TTL', null),

        /*
        |--------------------------------------------------------------------------
        | Refresh time to live
        |--------------------------------------------------------------------------
        |
        | Specify the length of time (in minutes) that the token can be refreshed
        | within. I.E. The user can refresh their token within a 2 week window of
        | the original token being created until they must re-authenticate.
        | Defaults to 2 weeks.
        |
        | You can also set this to null, to yield an infinite refresh time.
        | Some may want this instead of never expiring tokens for e.g. a mobile app.
        | This is not particularly recommended, so make sure you have appropriate
        | systems in place to revoke the token if necessary.
        |
        */

        'refresh_ttl' => env('JWT_REFRESH_TTL', null),

        /*
        |--------------------------------------------------------------------------
        | Required Claims
        |--------------------------------------------------------------------------
        |
        | Specify the required claims that must exist in any token.
        | A TokenInvalidException will be thrown if any of these claims are not
        | present in the payload.
        |
        */

        'required_claims' => [
            'iss',
            'iat',
            'nbf',
            'sub',
            'jti',
        ],
    ];
?>