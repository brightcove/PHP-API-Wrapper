<?php

$data = file_get_contents('php://input');
file_put_contents('server_out.txt', $data);

http_response_code(200);
return TRUE;
