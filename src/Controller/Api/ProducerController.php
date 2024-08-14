<?php

namespace App\Controller\Api;

use App\Entity\AddressExploitation;
use App\Entity\AddressProducer;
use App\Entity\Corporation;
use App\Entity\Exploitation;
use App\Entity\Producer;
use App\Entity\ProductionPhase;
use App\Repository\AddressExploitationRepository;
use App\Repository\AddressProducerRepository;
use App\Repository\ExploitationRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProducerController extends AbstractController
{
    #[Route('/api/v1/producers', name: 'app_producers', methods: ['POST'])]
    public function create(
        Request $request,
        ProductRepository $productRepository,
        ExploitationRepository $exploitationRepository,
        AddressProducerRepository $addressProducerRepository,
        AddressExploitationRepository $addressExploitationRepository,
        ManagerRegistry $managerRegistry,
        SerializerInterface $serializer
    ) {
        try {
            /**
             * Identify a new producer with all informations
             */
            //create producer
            $producer = new Producer();
            $producerInfo = $request->getPayload()->all()["producer"];

            $producer->setFirstname($producerInfo["firstname"]);
            $producer->setMiddlename($producerInfo["middlename"]);
            $producer->setLastname($producerInfo["lastname"]);
            $producer->setGender($producerInfo["gender"]);
            $producer->setNumberOfChildren($producerInfo["numberOfChildren"]);
            $producer->setMaritalStatus($producerInfo["maritalStatus"]);
            $producer->setBirthdate(date_create_from_format("Y-m-d", $producerInfo["birthdate"]));
            $producer->setHandicap($producerInfo["handicap"]);
            $producer->setAverageMonthIncome($producerInfo["averageMonthIncome"]);
            $producer->setCreatedAt(new \DateTimeImmutable());
            //add producer to a corporation
            $corporations = $producerInfo["corporations"];
            $corpo = null;
            $manager = $managerRegistry->getManager();
            if(empty($corporations)){
                $corpo = new Corporation();
                $corpo->setCreatedAt(new \DateTimeImmutable());
                $corpo->setCreationDate(new \DateTime());
                $corpo->setName("DEFAULT_CORPO");
                $corpo->setDetails("NA");
                $corpo->hasLegalExistance(false);
                $manager->persist($corpo);
                $producer->addCorporation($corpo);
            }

            if (array_key_exists("phone", $producerInfo)) {
                $producer->setPhone($producerInfo["phone"]);
            }

            if (array_key_exists("email", $producerInfo)) {
                $producer->setEmail($producerInfo["email"]);
            }

            // Producer address
            $producerAddress = new AddressProducer();
            $addressInfo = $producerInfo["address"];
            $producerAddress->setCountry($addressInfo["country"]);
            $producerAddress->setProvince($addressInfo["province"]);
            $producerAddress->setCity($addressInfo["city"]);
            $producerAddress->setTerritory($addressInfo["territory"]);
            $producerAddress->setSector($addressInfo["sector"]);
            $producerAddress->setVillage($addressInfo["village"]);
            $producerAddress->setCreatedAt(new \DateTimeImmutable());
            $producer->setAddress($producerAddress);
            $producer->setCreatedBy($this->getUser());

            $manager->persist($producerAddress);
            $manager->persist($producer);

            $fields = $request->getPayload()->all()["fields"];
            if (!empty($fields)) {
                foreach ($fields as $field) {
                    $pId = $field["productId"];
                    $product = $productRepository->find($pId);
                    if (empty($product)) {
                        return $this->json(["message" => "No Product Found with ID: " . $pId], 404);
                    }
                    $exp = new Exploitation();
                    $exp->setSurfaceAcres($field["surface_acres"]);
                    $exp->setStartedAt(date_create_from_format("Y-m-d", $field["startedAt"]));
                    $exp->setStatus($field["status"]);
                    $exp->setProduct($product);
                    $exp->setCorporation($corpo);
                    $expAddress = $field["address"];
                    $adr = new AddressExploitation();
                    $adr->setProvince($expAddress["province"]);
                    $adr->setDistrict($expAddress["district"]);
                    $adr->setSector($expAddress["sector"]);
                    $adr->setVillage($expAddress["village"]);
                    $adr->setLat($expAddress["lat"]);
                    $adr->setLng($expAddress["lng"]);
                    if (!array_key_exists("city", $expAddress)) {
                        $adr->setCity("NA");
                    }
                    $manager->persist($adr);
                    

                    $exp->setAddress($adr);
                    $exp->setCreatedAt(new \DateTimeImmutable());
                    $manager->persist($exp);

                    $phases = $field["productionPhases"];
                    if (!empty($phases)) {
                        foreach ($phases as $ph) {
                            $expPhase = new ProductionPhase();
                            $expPhase->setTitle($ph["title"]);
                            $expPhase->setSeedSource($ph["seedSource"]);
                            $expPhase->setFertilizer($ph["fertilizer"]);
                            $expPhase->setOperationnalMode($ph["operationnalMode"]);
                            $expPhase->setSeason($ph["season"]);
                            $expPhase->setYear($ph["year"]);
                            $expPhase->setExploitation($exp);
                            $expPhase->setCreatedAt(new \DateTimeImmutable());
                            
                            $manager->persist($expPhase);
                        }
                    }
                }
            }
            $manager->flush();
            return $this->json(["producer" => json_decode($serializer->serialize($producer, 'json', ['groups' => ['producer']])) ]);
        } catch (\Throwable $th) {
            return $this->json(["Message" => $th->getMessage()], 500);
        }
    }
}
