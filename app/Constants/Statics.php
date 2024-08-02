<?php

namespace App\Constants;

class Statics
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    const IS_NULL = null;
    const IS_PAY = true;
    const IS_NOT_PAY = false;

    const PENDING = 0;
    const DONE = 1;
    const RECEPTION = 2;
    const ACCOUNTS = 3;
    const ABSENT = 4;

    const DEFAULT_IMAGE_SET = 'assets/images/avatar.png';

    const DEFAULT_LOGO_SET = 'assets/images/logo.png';

    const DEFAULT_RECEIPT_SET = 'assets/images/default-receipt.png';
}