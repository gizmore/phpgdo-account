<?php
namespace GDO\Account\Websocket;

use GDO\Account\Method\Settings;
use GDO\Websocket\Server\GWS_CommandForm;
use GDO\Websocket\Server\GWS_Commands;

final class WS_Settings extends GWS_CommandForm
{
    public function getMethod()
    {
        return Settings::make();
    }
}

GWS_Commands::register(0x0121, new WS_Settings());
