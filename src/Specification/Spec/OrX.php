<?php

namespace Specification\Spec;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

/**
 * OrX specification
 * 
 * @author Benjamin GrOrfond <benjaming@theodo.fr>
 */
class OrX implements SpecificationInterface
{
    private $children;

    /**
     * Add as many children as you want.
     * Usage: $spec = new OrX(new Spec(), new Spec());
     */
    public function __construct()
    {
        $this->children = func_get_args();
    }

    /**
     * {@inheritdoc}
     */
    public function match(QueryBuilder $qb, $dqlAlias)
    {
        return call_user_func_array(
            array($qb->expr(), 'orX'),
            array_map(function ($specification) use ($qb, $dqlAlias) {
                    return $specification->match($qb, $dqlAlias);
                }, $this->children
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyQuery(AbstractQuery $query)
    {
        foreach ($this->children as $child) {
            $child->modifyQuery($query);
        }
    }
}