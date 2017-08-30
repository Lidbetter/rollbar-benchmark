<?php

class RollbarNewNullSender implements \Rollbar\Senders\SenderInterface
{
    public function send($scrubbedPayload, $accessToken)
    {
        return new \Rollbar\Response(0, "null");
    }

    public function sendBatch($batch, $accessToken)
    {
        return new \Rollbar\Response(0, "null");
    }

    public function wait($accessToken, $max)
    {
        return new \Rollbar\Response(0, "null");
    }
}
