<?php

namespace RC\http\mocks;

use RC\http\Request;
use RC\http\Response;

class SubscriptionMock extends Mock
{

    protected $path = '/restapi/v1.0/subscription';

    protected $expiresIn = 54000; // 15 * 60 * 60

    public function __construct($expiresIn = 54000)
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * @inheritdoc
     */
    public function getResponse(Request $request)
    {

        return new Response(200, self::createBody(array(
            'eventFilters'   => $request->getBody()['eventFilters'],
            'expirationTime' => date('c', time() + $this->expiresIn),
            'expiresIn'      => $this->expiresIn,
            'deliveryMode'   => array(
                'transportType' => 'PubNub',
                'encryption'    => false,
                'address'       => '123_foo',
                'subscriberKey' => 'sub-c-foo',
                'secretKey'     => 'sec-c-bar'
            ),
            'id'             => 'foo-bar-baz',
            'creationTime'   => date('c'),
            'status'         => 'Active',
            'uri'            => 'https=>//platform.ringcentral.com/restapi/v1.0/subscription/foo-bar-baz'
        )));

    }

}