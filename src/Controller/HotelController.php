<?php

namespace App\Controller;

use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
    /**
     * @Route("/hotels", name="getHotels", methods="GET")
     *
     * @param HotelRepository $hotel
     * @return JsonResponse
     */
    public function list(HotelRepository $hotel)
    {
        return new JsonResponse(
            ['hotels' => $hotel->getAll()],
            Response::HTTP_OK
        );
    }
}

