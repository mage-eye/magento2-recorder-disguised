<?php
/*
 * Copyright Jerke Combee. All rights reserved.
 * https://www.jcombee.nl/
 */

declare(strict_types=1);

namespace src\Plugin\Record;

use Magento\Framework\DataObjectFactory;
use Magento\Framework\Event\ManagerInterface;
use src\Recorder;

class DispatchedEvent
{
    public function __construct(protected readonly DataObjectFactory $dataObjectFactory)
    {
    }

    public function beforeDispatch(ManagerInterface $eventManager, $eventName, array $data = [])
    {
        Recorder::record('event', $this->dataObjectFactory->create([
            'data' => [
                'event_name' => $eventName,
                'data' => $data,
            ],
        ]));

        return [$eventName, $data];
    }
}
