<?php

session_start();
session_destroy();
echo '
        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
                .loader {
                    margin: auto;
                    margin-top: 280px;
                    border: 16px solid #f3f3f3;
                    border-radius: 50%;
                    border-top: 16px solid #3498db;
                    width: 50px;
                    height: 50px;
                    -webkit-animation: spin 2s linear infinite;
                }
        
                @keyframes spin {
                    0% {
                        transform: rotate(0deg);
                    }
        
                    100% {
                        transform: rotate(360deg);
                    }
                }
            </style>
        </head>
        
        <body>
            <div class="loader"></div>
        </body>
        
        </html>
    ';
header("Refresh: 2; url=login.php");
