<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use App\Service\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="getReview", methods="GET")
     *
     * @param Request $request
     * @param Validator $validator
     * @param ReviewRepository $review
     * @return JsonResponse
     */
    public function graph(Request $request, Validator $validator, ReviewRepository $review)
    {
        // Parse request
        $params = $request->query->all();
        if (empty($params)) {
            return new JsonResponse(['error' => 'No parameter found.'], Response::HTTP_BAD_REQUEST);
        }

        // Validate request
        $error = $validator->isValid($params);
        if ($error !== true) {
            return new JsonResponse(['error' => $error],  Response::HTTP_BAD_REQUEST );
        }

        $days = (strtotime($params['toDate']) - strtotime($params['fromDate'])) / (60 * 60 * 24);
        $response = false;
        if ($days >= 1 && $days <= 29) {
            $response = $review->getDayGroup($params);
        } elseif ($days >= 30 && $days <= 89) {
            $response = $review->getWeekGroup($params);
        } elseif ($days > 89) {
            $response = $review->getMonthGroup($params);
        }

        return new JsonResponse(['graph' => $response],Response::HTTP_OK);
    }
}
