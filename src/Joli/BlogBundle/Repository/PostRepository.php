<?php
namespace Joli\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository
{
    public function findAll()
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->add('select', 'p')
            ->add('from', 'Post p')
            ->add('where', 'p.is_published = :published')
            ->add('orderBy', 'p.created_at DESC')
            ->setParameter('published', true)
            ->getResult();
    }
}