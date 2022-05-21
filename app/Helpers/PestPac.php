<?php

namespace App\Helpers;

use App\Models\PestPacBranch;
use App\Services\PestPacService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use JsonException;

/**
 *
 */
class PestPac
{

    /**
     * @return Collection|PestPacBranch[]
     */
    public static function branches()
    {
        return PestPacBranch::orderBy('name')->get();
    }// branches

}// PestPac
