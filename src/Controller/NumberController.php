<?php

namespace App\Controller;

use App\Representation\Hydrator\ListNumbersHydrator;
use App\Services\Number\Application\Query\GetNumbersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NumberController extends AbstractController
{

    #[Route('/', name: 'homePage')]
    public function homePage()
    {
        return $this->render('number-viewer.html.twig');
    }

    #[Route('/api/number', name: 'number')]
    public function getNumbers(
        Request $request,
        GetNumbersQuery $getNumbersQuery,
        ListNumbersHydrator $listNumbersHydrator
    ): Response {
        $countryCode = null;
        if (!empty($request->query->get('columns')[0]['search']['value'])) {
            $countryCode = $request->query->get('columns')[0]['search']['value'];
        }
        $validState = null;
        if (!empty($request->query->get('columns')[1]['search']['value'])) {
            $validState = $request->query->get('columns')[1]['search']['value'];
        }
        list($phoneNumbers, $count) = $getNumbersQuery->execut(
            $request->query->get('length'),
            $request->query->get('start'),
            (int) $countryCode,
            match ($validState) {
                'OK' => true,
                'NOK' => false,
                default => null,
            }
        );

        return $this->json([
            'status' => 'success',
            'data' => $listNumbersHydrator->hydrate($phoneNumbers),
            "draw" => $request->query->get('draw'),
            "recordsTotal" => 41,
            "recordsFiltered" => $count
        ]);
    }
}
