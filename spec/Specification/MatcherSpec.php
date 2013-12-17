<?php

namespace spec\Specification;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Specification\Spec\SpecificationInterface;

class MatcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Specification\Matcher');
    }

    function it_should_call_the_match_method_of_the_specification_and_then_return_a_query_object(
        EntityRepository $repository,
        SpecificationInterface $spec,
        QueryBuilder $qb,
        Expr $expr,
        AbstractQuery $query
    )
    {
        $alias = "a";

        $repository->createQueryBuilder($alias)->shouldBeCalled()->willReturn($qb);
        $spec->match($qb, $alias)->shouldBeCalled()->willReturn($expr);
        $qb->where($expr)->shouldBeCalled()->willReturn($qb);
        $qb->getQuery()->shouldBeCalled()->willReturn($query);
        $spec->modifyQuery($query)->shouldBeCalled();

        $this->match($repository, $alias, $spec)->shouldReturnAnInstanceOf('Doctrine\ORM\AbstractQuery');
    }
}
