<?php

namespace NoobPress\Security\RPC;

class Subscriber
{
    /**
     * @hook xmlrpc_enabled
     */
    public function disable_rpc()
    {
        return false;
    }

    /**
     * @hook wp_headers
     */
    public function remove_pingback( $headers )
    {
        unset( $headers['X-Pingback'] );
        return $headers;
    }
}