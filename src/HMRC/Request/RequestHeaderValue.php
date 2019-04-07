<?php

namespace HMRC\Request;

abstract class RequestHeaderValue
{
    /** @var string header value application/json */
    public const APPLICATION_JSON = 'application/json';

    // header values for GOV_CLIENT_CONNECTION_METHOD header

    /** @var string Installed mobile application connecting directly to HMRC */
    public const MOBILE_APP_DIRECT = 'MOBILE_APP_DIRECT';

    /** @var string Installed desktop application connecting directly to HMRC */
    public const DESKTOP_APP_DIRECT = 'DESKTOP_APP_DIRECT';

    /** @var string Installed mobile application connecting through intermediary servers to HMRC */
    public const MOBILE_APP_VIA_SERVER = 'MOBILE_APP_VIA_SERVER';

    /** @var string Installed desktop application connecting through intermediary servers to HMRC */
    public const DESKTOP_APP_VIA_SERVER = 'DESKTOP_APP_VIA_SERVER';

    /** @var string Web application connecting through intermediary servers to HMRC */
    public const WEB_APP_VIA_SERVER = 'WEB_APP_VIA_SERVER';

    /** @var string Batch process connecting directly to HMRC */
    public const BATCH_PROCESS_DIRECT = 'BATCH_PROCESS_DIRECT';

    /** @var string The application connects directly to HMRC but the method does not fit into the architectures described above. */
    public const OTHER_DIRECT = 'OTHER_DIRECT';

    /** @var string The application connects through intermediary servers to HMRC but the method does not fit into the architectures described above. */
    public const OTHER_VIA_SERVER = 'OTHER_VIA_SERVER';
}
