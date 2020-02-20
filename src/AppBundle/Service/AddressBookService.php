<?php


namespace AppBundle\Service;


use AppBundle\Entity\Address;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;

class AddressBookService extends EntityRepository
{
    public function saveAddress(array $data)
    {
        try {
            $entityManager = $this->getEntityManager();
            $entityManager->persist(new Address());
            $entityManager->flush();
        } catch (OptimisticLockException $e) {
        }
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function getAddress(int $id)
    {
        return $this->find($id);
    }
}