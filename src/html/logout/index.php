<?php

session_start();

session_destroy();

?>

<html>
    <head>
        <script
            src="https://ok1static.oktacdn.com/assets/js/sdk/okta-signin-widget/2.6.0/js/okta-sign-in.min.js"
            type="text/javascript"></script>
    </head>
    <body>
        <div id="okta-login-container"></div>

        <script type="text/javascript">
            var oktaSignIn = new OktaSignIn({
              baseUrl: "https://dev-209822.oktapreview.com",
              clientId: "0oag8ydp2tj7NTaww0h7",
              redirectUri: "http://192.168.2.20/login_callback",
              authParams: {
                issuer: "https://dev-209822.oktapreview.com/oauth2/default",
                responseType: ['code'],
                display: 'page'
              }
            });
            oktaSignIn.session.close(function (err) {
                window.location.replace('/');
            });
          </script>
    </body>
</html>