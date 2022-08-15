<?php

namespace App\Controller;

use App\Entity\ServiceAnalytic;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="app_api")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path'    => 'src/Controller/ApiController.php'
        ]);
    }

    /**
     * @Route("/api/post_api", name="post_api", methods={"POST"})
     */
    public function post_api(Request $request , ManagerRegistry $doctrine): Response
    {
        $serviceAnalytics     = new ServiceAnalytic();
        $parameter = json_decode($request->getContent(),true);
        // dd($parameter);
        $serviceAnalytics->setServiceName($parameter['service_name']);
        $serviceAnalytics->setStartDate($parameter['start_date']);
        $serviceAnalytics->setEndDate($parameter['end_date']);
        $serviceAnalytics->setStatusCode($parameter['status_code']);
        $em = $doctrine->getManager();
        $em->persist($serviceAnalytics);
        $em->flush();
        return $this->json('Inserted Successfully!');
    }

    /**
     * @Route("/api/fetchapi_count", name="fetchapi_count", methods={"GET"})
     */
    public function fetchapi_count(): Response
    {
        
    }


}
