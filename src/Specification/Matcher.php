<?php

namespace Specification;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Specification\Spec\SpecificationInterface;

class Matcher
{
    /**
     * @param EntityRepository       $repository
     * @param string                 $alias
     * @param SpecificationInterface $spec
     * @return \Doctrine\ORM\Query
     */
    public function match(EntityRepository $repository, $alias, SpecificationInterface $spec)
    {
        $qb = $repository->createQueryBuilder($alias);

        $expr = $spec->match($qb, $alias);
        $query = $qb->where($expr)->getQuery();

        $spec->modifyQuery($query);

        return $query;
    }
}
