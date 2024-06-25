<?php
header("Content-Security-Policy: default-src 'self'; " .
       "script-src 'self' 'unsafe-inline' 'self' 'js/form.js' 'self' 'js/index.js' 'self' 'js/register.js' 'self' 'js/scripts.js'; " .
       "style-src 'self' 'unsafe-inline' 'self' 'css/style.css' 'self' 'css/styles.css' 'self' 'css/styless.css' 'self' 'css/footer.css' 'self' 'css/delete.css' 'self' 'css/header.css' 'self' 'css/profile.css'; " .
       "img-src 'self' data:; " .
       "connect-src 'self'; " .
       "frame-src 'self'; " .
       "object-src 'none'; " .
       "base-uri 'self'; " .
       "form-action 'self'; " .
       "frame-ancestors 'self';");
?>