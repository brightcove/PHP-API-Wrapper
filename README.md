# PHP Wrapper for the Brightcove API

## Installation notes

The only composer dependency for this library is PHPUnit, but it's only necessary if you intend to run tests.

This library requires PHP 5.5 or newer with a CURL extension.

	# apt-get install php5 php5-curl curl

	PHP-API-Wrapper$ curl -sS https://getcomposer.org/installer | php

	PHP-API-Wrapper$ php composer.phar install

## Testing notes

The test has a lot of command line options. It is advised that you create a shell script to run the test.

Example script:

    #!/bin/sh
    
    ssh -nNT -R 8888::8888 example.com &>ssh_tunnel_logfile.txt &
    PID=$!
    
    cleanup () {
        kill ${PID}
        cat ssh_tunnel_logfile.txt
        rm ssh_tunnel_logfile.txt
    }
    
    handle_error () {
        cleanup
        exit 1
    }
    
    for i in brightcove_test.php brightcove_crud_test.php brightcove_search_test.php; do
        ./vendor/bin/phpunit ${i} \
            --client-id="xxx" \
            --client-secret="xxx" \
            --account="nnn" \
            --callback-host="localhost:8888" \
            --callback-addr-remote="http://example.com:8888" \
            || handle_error
    done
    
    cleanup

The reverse SSH tunnel is needed for the DI API test. When you set it up, make sure that the port is open on the remote
server too.
