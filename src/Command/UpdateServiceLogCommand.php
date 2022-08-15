<?php

namespace App\Command;

use App\Entity\ServiceLogs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UpdateServiceLogCommand extends Command
{
    /*  Here we added short description of command */
    protected static $defaultName = 'UpdateServiceLog';
    protected static $defaultDescription = 'Behind the scene command is working on an algorithm which is basically parses the file and insert it into database. It is importing manually, and it should be able to start where it left off when interrupted';
    private $projectDir;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    // construct function
    // set default file path

    public function __construct(string $projectDir, EntityManagerInterface $entityManager)
    {
        $this->projectDir     = $projectDir;
        $this->entityManager  = $entityManager;
        parent::__construct();
    }

    // execute function
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /***********************************************************/
        /*  LOGIC FOR GETTING FILE DATA AND IMPORT INTO DB & OTHER */
        /***********************************************************/

        //  get file from the path
        $inputFile = $this->projectDir.'\public\logs.csv';
        // initialize object for styling
        $io        = new SymfonyStyle($input, $output);
        $row       = 1;         // set row to 1
        $item      = array();   // set item array variable
        $itemJson  = '';
        //  loop through logs csv file
        if (($handle = fopen($inputFile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $io->note(sprintf($num.' fields in line '.$row));
                $row++;
                // loop over each one column
                for ($c=0; $c < $num; $c++) {
                    $io->note(sprintf('You are about to '));
                    $io->note(sprintf($data[$c]));
                    // Debug all records to verify
                    if( $c == 0 ) { $item['service_name'] = $data[$c]; }
                    else if( $c == 1 ) { $item['created_at'] = $data[$c]; }
                    else if( $c == 2 ) { $item['service_url'] = $data[$c]; }
                    else { $item['status_code'] = $data[$c]; }
                }
                // encode data in to json
                $output->writeln(json_encode($item));
                $itemJson   = json_encode($item);
                // check service item with parameter
                $this->checkServiceItem($itemJson);
                // flush all records
                $this->entityManager->flush();
            }
            fclose($handle);
        }
        $io->success('Data Inserted Successfully!');
        return Command::SUCCESS;

        /***********************************************************/
        /***********************************************************/
        /***********************************************************/
    }

    // function for checking service item
    public function checkServiceItem($serviceProduct)
    {
        $serviceProduct = json_decode($serviceProduct, true);
        // check weather the data exists already in db or not
        $serviceItemRepo = $this->entityManager->getRepository(ServiceLogs::class);
        $existingServiceItem  = $serviceItemRepo->findOneBy(['service_name' => $serviceProduct['service_name']]);
        // dump($existingStockItem);
        // check  the service item already exists or not
        if( $existingServiceItem ) {
            // update service item if exists
            $this->updateServiceItem($existingServiceItem, $serviceProduct);
            // continue;
        }
        // otherwise create new service item
        $this->createNewServiceItem($serviceProduct);
    }

    // function for  create new service item
    public function createNewServiceItem($serviceProduct){
        // call entity
        $newServiceItem   = new ServiceLogs();
        // adds new items to Service DB
        $newServiceItem->setServiceName($serviceProduct['service_name']);
        $newServiceItem->setCreatedAt($serviceProduct['created_at']);
        $newServiceItem->setServiceUrl($serviceProduct['service_url']);
        $newServiceItem->setStatusCode($serviceProduct['status_code']);
        $this->entityManager->persist($newServiceItem);

    }

    // function for  update service item
    public function updateServiceItem($existingStockItem , $supplierProduct){
        // update item in Service DB
        $existingStockItem->setStatusCode($supplierProduct['status_code']);
        $this->entityManager->persist($existingStockItem);

    }
}
