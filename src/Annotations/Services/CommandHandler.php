<?php

/**
 * PHP Service Bus (CQS implementation)
 *
 * @author  Maksim Masiukevich <desperado@minsk-info.ru>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace Desperado\ServiceBus\Annotations\Services;

use Desperado\ServiceBus\Annotations\AbstractAnnotation;
use Desperado\ServiceBus\Annotations\Services\Traits;

/**
 * Annotation indicating to the command handler
 *
 * Handler can be called via the http request (and not only from the transport bus, for example, a rabbitMq. The
 * command can still be called using the transport bus).
 *
 * The command should implement the interface "\Desperado\ServiceBus\Messages\HttpMessageInterface"
 *
 * To support working with the http entry point, you must specify the `$route` and `$method`
 *
 * @see HttpSupportTrait
 *
 * @Annotation
 * @Target("METHOD")
 */
final class CommandHandler extends AbstractAnnotation
    implements MessageHandlerAnnotationInterface, HttpHandlerAnnotationInterface
{
    use Traits\LoggerChannelTrait;
    use Traits\HttpSupportTrait;
}
