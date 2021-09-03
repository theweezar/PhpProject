<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title><?php echo isset($viewData['message']) ? $viewData['message'] : 'Page not found' ?></title>

        <!-- Google font -->
        <link
        href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700"
        rel="stylesheet"
        />

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <style>
            * {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            body {
                padding: 0;
                margin: 0;
            }

            #notfound {
                position: relative;
                height: 100vh;
            }

            .notfound .notfound-404 h1 {
                font-family: "Montserrat", sans-serif;
                font-size: 236px;
                font-weight: 200;
                margin: 0px;
                color: #211b19;
                text-transform: uppercase;
                text-align: center;
            }

            .notfound .notfound-404 h2 {
                font-family: "Montserrat", sans-serif;
                font-size: 28px;
                font-weight: 400;
                text-transform: uppercase;
                color: #211b19;
                background: #fff;
                margin: 0;
                text-align: center;
            }

            .notfound a {
                font-family: "Montserrat", sans-serif;
                display: inline-block;
                font-weight: 700;
                text-decoration: none;
                color: #fff;
                text-transform: uppercase;
                padding: 13px 23px;
                background: #ff6300;
                font-size: 18px;
                -webkit-transition: 0.2s all;
                transition: 0.2s all;
            }

            .notfound a:hover {
                color: #ff6300;
                background: #211b19;
            }

            @media only screen and (max-width: 767px) {
                .notfound .notfound-404 h1 {
                font-size: 148px;
                }
            }

            @media only screen and (max-width: 480px) {
                .notfound .notfound-404 {
                height: 148px;
                margin: 0px auto 10px;
                }
                .notfound .notfound-404 h1 {
                font-size: 86px;
                }
                .notfound .notfound-404 h2 {
                font-size: 16px;
                }
                .notfound a {
                padding: 7px 15px;
                font-size: 14px;
                }
            }
        </style>
    </head>

    <body>
        <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>Oops!</h1>
                <h2>
                    <?php echo isset($viewData['statusCode']) ? $viewData['statusCode'] : '404' ?>
                    -
                    <?php echo isset($viewData['message']) ? $viewData['message'] : 'Page not found' ?>
                </h2>
            </div>
        </div>
        </div>
    </body>
</html>
