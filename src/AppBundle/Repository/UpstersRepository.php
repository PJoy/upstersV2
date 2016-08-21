<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 20/08/2016
 * Time: 17:22
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UpstersRepository extends EntityRepository
{
    public function setPublishedTrue($id)
    {
        $this->createQueryBuilder('article')
            ->update()
            ->set('article.published','?1')
            ->where('article.id = ?2')
            ->setParameter(1, true)
            ->setParameter(2, $id)
            ->getQuery()
            ->execute();

        $this->createQueryBuilder('article')
            ->update()
            ->set('article.date', '?1')
            ->where('article.id = ?2')
            ->setParameter(1, date('d/m/Y'))
            ->setParameter(2, $id)
            ->getQuery()
            ->execute();

        return true;
    }

    public function setPublishedFalse($id)
    {
        return $this->createQueryBuilder('article')
            ->update()
            ->set('article.published','?1')
            ->where('article.id = ?2')
            ->setParameter(1, false)
            ->setParameter(2, $id)
            ->getQuery()
            ->execute();
    }
}