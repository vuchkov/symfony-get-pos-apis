<?php

declare(strict_types=1);

namespace App\Controller;

use App\Helper\PosApisHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class PosApisController extends AbstractController
{
    private PosApisHelper $posApisHelper;

    public function __construct(PosApisHelper $posApisHelper)
    {
        $this->posApisHelper = $posApisHelper;
    }

    /**
     * @Route("/jokes", name="app_jokes")
     */
    #[Route('/jokes', name: 'api_list')]
    public function jokes(): Response
    {
        $dataArr = $this->posApisHelper->getRandomApi();

        $response = new Response();
        $response->setContent(json_encode($dataArr));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
        /*return $this->render('jokes.html.twig', [
            'arr' => $dataArr,
        ]);*/
    }
}