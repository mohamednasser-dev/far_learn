<!DOCTYPE html>
<head>
    <title>Zoom WebSDK</title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.1/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.1/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

</head>

<body>
    <style>
        .sdk-select {
            height: 34px;
            border-radius: 4px;
        }

        .websdktest button {
            float: right;
            margin-left: 5px;
        }

        #nav-tool {
            margin-bottom: 0px;
        }

        #show-test-tool {
            position: absolute;
            top: 100px;
            left: 0;
            display: block;
            z-index: 99999;
        }

        #display_name {
            width: 250px;
        }


        #websdk-iframe {
            width: 700px;
            height: 500px;
            border: 1px;
            border-color: red;
            border-style: dashed;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            left: 50%;
            margin: 0;
        }
    </style>

    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Zoom WebSDK</a>
            </div>
            <div id="navbar" class="websdktest">
            </div>
        </div>
    </nav>

    <script src="https://source.zoom.us/1.9.1/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.9.1.min.js"></script>
    <script src="{{ asset('zoom/js/tool.js') }}"></script>
    <script src="{{ asset('zoom/js/vconsole.min.js') }}"></script>
    <script src="{{ asset('zoom/js/index.js') }}"></script>
    <script>
    </script>
</body>

</html>
