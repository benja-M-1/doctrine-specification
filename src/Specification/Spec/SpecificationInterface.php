<?php

namespace Specification\Spec;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

/**
 * SpecificationInterface
 * 
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
interface SpecificationInterface 
{
    /**
     * Apply the specification to the QueryBuilder instance.
     *
     * @param QueryBuilder $qb
     * @param $dqlAlias
     * @return Expr
     */
    public function match(QueryBuilder $qb, $dqlAlias);

    /**
     * Change the behavior of the query after being generated.
     *
     * @param AbstractQuery $query
     * @return AbstractQuery
     */
    public function modifyQuery(AbstractQuery $query);
}
 