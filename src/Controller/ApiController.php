<?php

namespace App\Controller;

use App\Entity\ServiceAnalytic;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
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
     * @Route("/api/fetchapi_count/{servicename?}/{statuscode?}/{startdate?}/{enddate?}", name="fetchapi_count", methods={"GET"})
     *
     * @param string|null $servicename
     * @param string|null $statuscode
     * @param string|null $startdate
     * @param string|null $enddate
     * @return Response
     */
    public function fetchapi_count(?string $servicename = null , ?string $statuscode = null , ?string $startdate = null , ?string $enddate = null): Response
    {
        $searchParameters       = array();
        $serviceAnalyticsData   = $this->entityManager->getRepository(ServiceAnalytic::class);
        // set parameters for search
        if( !empty($servicename))  { $searchParameters['serviceName']  = $servicename; }
        if( !empty($statuscode) ) { $searchParameters['statusCode']    = $statuscode; }
        if( !empty($startdate)) { $searchParameters['startDate']       = $startdate; }
        if( !empty($enddate) ) { $searchParameters['endDate']          = $enddate; }

        // dd($searchParameters);
        // query for search parameters
        $data                   = $serviceAnalyticsData->findBy(
                                                                $searchParameters
                                                             );
        // dd($data);
        $count = 0; // set counter 0
        foreach ($data as $d){
            // count ++ for every record
            $count++;
        }
        dd($count);
    }
}
