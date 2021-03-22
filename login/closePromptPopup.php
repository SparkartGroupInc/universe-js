<!DOCTYPE html>
<html lang="en">
<body>

  <script>

    // After a successful login in the popup the parent window is redirected by
    // Universe to /login/reload (hardcoded path). This page is responsible for
    // storing the auth tokens, closing the popup and navigating to the final
    // destination.

    function qsParam(name, defaultValue) {
      return decodeURIComponent((window.location.search.match(new RegExp('[\\?&]' + name + '=([^&#$]+)')) || [undefined, defaultValue || ''])[1]);
    };

    localStorage.setItem('universeAccessToken', qsParam('access_token'));
    localStorage.setItem('universeAccessTokenExpiration', qsParam('access_token_expiration', '0') * 1000);
    localStorage.setItem('universeRefreshToken', qsParam('refresh_token'));
    localStorage.setItem('universeRefreshTokenExpiration', qsParam('refresh_token_expiration', '0') * 1000);

    const redirect = localStorage.getItem('universeLoginRedirect') || qsParam('redirect', '/');
    localStorage.removeItem('universeLoginRedirect');

    window.location.href = redirect;

  </script>

</body>
</html>
