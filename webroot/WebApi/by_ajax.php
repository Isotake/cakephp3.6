<?php

ini_set('display_errors', 1);
error_reporting(-1);

?>
<html>
<head>
    <title>sendmail</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        const func_ajax = function () {
            // CSRFが有効
            //let ajax_url = 'http://192.168.1.133/caketest/WebApi/response_json_data';
            // プレフィックスapiはCSRFが無効
            let ajax_url = 'http://192.168.1.133/caketest/api/WebApi/response_json_data';
            $.ajax({
                url: ajax_url,
                type: 'GET',
                dataType: 'json',
                timeout: 10000,
                error: function (xhr, status, errorThrown) {
                    console.log('error');
                },
                success: function (data, status, xhr) {
                    console.log(data);
                }
            });
        };
        func_ajax();
    </script>
</head>
<body>
</body>
</html>
