<?php

/**
 * PHP Service Bus (publish-subscribe pattern implementation)
 * Supports Saga pattern and Event Sourcing
 *
 * @author  Maksim Masiukevich <desperado@minsk-info.ru>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace Desperado\ServiceBus\EventSourcing\EventStreamStore;

use Desperado\ServiceBus\EventSourcing\Aggregate;
use Desperado\ServiceBus\EventSourcing\AggregateId;

/**
 * Aggregates store
 */
interface AggregateStore
{
    /**
     * Save new event stream
     *
     * @psalm-suppress InvalidReturnType Incorrect resolving the value of the generator
     *
     * @param StoredAggregateEventStream $aggregateEventStream
     *
     * @return \Generator It does not return any result
     *
     * @throws \Desperado\ServiceBus\EventSourcing\EventStreamStore\Exceptions\NonUniqueStreamId
     * @throws \Desperado\ServiceBus\EventSourcing\EventStreamStore\Exceptions\SaveStreamFailed
     */
    public function saveStream(StoredAggregateEventStream $aggregateEventStream): \Generator;

    /**
     * Append events to exists stream
     *
     * @psalm-suppress InvalidReturnType Incorrect resolving the value of the generator
     *
     * @param StoredAggregateEventStream $aggregateEventStream
     *
     * @return \Generator It does not return any result
     *
     * @throws \Desperado\ServiceBus\EventSourcing\EventStreamStore\Exceptions\SaveStreamFailed
     */
    public function appendStream(StoredAggregateEventStream $aggregateEventStream): \Generator;

    /**
     * Load event stream
     *
     * @psalm-suppress InvalidReturnType Incorrect resolving the value of the generator
     *
     * @param AggregateId $id
     * @param int         $fromVersion
     * @param int|null    $toVersion
     *
     * @return \Generator<\Desperado\ServiceBus\EventSourcing\EventStreamStore\StoredAggregateEventStream|null>
     *
     * @throws \Desperado\ServiceBus\EventSourcing\EventStreamStore\Exceptions\LoadStreamFailed
     */
    public function loadStream(
        AggregateId $id,
        int $fromVersion = Aggregate::START_PLAYHEAD_INDEX,
        ?int $toVersion = null
    ): \Generator;

    /**
     * Marks stream closed
     *
     * @psalm-suppress InvalidReturnType Incorrect resolving the value of the generator
     *
     * @param AggregateId $id
     *
     * @return \Generator It does not return any result
     *
     * @throws \Desperado\ServiceBus\EventSourcing\EventStreamStore\Exceptions\CloseStreamFailed
     */
    public function closeStream(AggregateId $id): \Generator;
}
