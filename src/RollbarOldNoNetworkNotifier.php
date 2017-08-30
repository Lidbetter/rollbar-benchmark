<?php

class RollbarOldNoNetworkNotifier extends RollbarNotifier
{
    protected function make_api_call($action, $access_token, $post_data)
    {
        // no-op
    }
}
