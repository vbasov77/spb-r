<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Archive;


class KeyRepository extends Repository
{
    /**
     * @return string
     */
    public function accessToken(): string
    {
        return 'vk1.a.CmjRMM9N5qlxknEWMMYRfp5ZA6GQnhmsd3VbKwKbCwELVALUkDAVhxZl_CSNPbKUfh4KDi1ITG2OP-NiolhUu5u7RZBLHpPkb3VV-czcClergl-rTI9gkOCGG_IltFSWzvXo8yFkQajYwzbGfjTgz9_vPnlBOoeBtwyFsC0toJ_cQ8k5EUZgtC0iTAMJtOMJOKB1j00re6ZceqCL5L7g0g';
    }

    /**
     * @return string
     */
    public function telegramBotMietenToken(): string
    {
        return "7420812478:AAGW2NCqwAE1nKh-ng2_3iZxrxDqug3vBrU";
    }

    public function idGroupVk(): int
    {
        return 227627516; // 7754824
    }

    public function idTgChannel(): string
    {
        return "-1002453188364";
    }
}