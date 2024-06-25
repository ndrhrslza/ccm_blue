<?php
header("Content-Security-Policy: default-src 'self'; " .
       "script-src 'self' 'js/form.js' 'js/index.js' 'js/register.js' 'js/scripts.js'; " .
       "style-src 'self' 'css/style.css' 'css/styles.css' 'css/styless.css' 'css/footer.css' 'css/delete.css' 'css/header.css' 'css/profile.css'; " .
       "img-src 'self' data:; " .
       "connect-src 'self'; " .
       "frame-src 'self'; " .
       "object-src 'none'; " .
       "base-uri 'self'; " .
       "form-action 'self'; " .
       "frame-ancestors 'self';");
?>