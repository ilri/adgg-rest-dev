<?php

namespace App\Controller;

use App\DataProvider\Paginator\MilkYieldRecordPaginator;
use App\Repository\MilkYieldRecordCachedDataRepository;
use Symfony\Component\HttpFoundation\Request;

class MilkYieldRecordController
{
    public function __invoke(Request $request, MilkYieldRecordCachedDataRepository $repository): MilkYieldRecordPaginator
    {
        $page = (int) $request->query->get('page', 1);
        return new MilkYieldRecordPaginator(
            $repository,
            $page,
            30
        );
    }
}