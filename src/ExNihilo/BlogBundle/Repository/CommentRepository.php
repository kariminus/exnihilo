<?php

namespace ExNihilo\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;


class CommentRepository extends \Doctrine\ORM\EntityRepository
{

    public function getCommentsForArticle($articleId)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.article = :articleId')
            ->addOrderBy('c.createdAt')
            ->setParameter('articleId', $articleId);


        return $qb->getQuery()
            ->getResult();
    }

}
