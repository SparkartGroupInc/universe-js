<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="referrer" content="origin">
    <script src="<?php echo get_template_directory_uri(); ?>/js/sparkart-universe-bundle.js"></script>
</head>
<body>

<a id="redirect" referrerpolicy="origin" style="display:none"></a>
<script>

    // Clear the auth tokens and redirect to Universe so it can clear its session
    // Make sure to remove the referrer path, to prevent a redirect loop

    localStorage.removeItem('universeAccessToken');
    localStorage.removeItem('universeAccessTokenExpiration');
    localStorage.removeItem('universeRefreshToken');
    localStorage.removeItem('universeRefreshTokenExpiration');

</script>
</body>
</html>
