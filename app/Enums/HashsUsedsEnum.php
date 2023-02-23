<?php

namespace App\Enums;

enum HashsUsedsEnum: string
{
    case ActiveAccount = 'Active Account';

    case RestorePassword = 'Restore Password';

    case ResendActiveAccount = 'Resend Active Account';
}
