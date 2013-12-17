<?php

namespace spec\Specification\Spec;

use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Specification\Spec\SpecificationInterface;

class OrXSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Specification\Spec\OrX');
    }

    function it_should_return_an_and_query(
        SpecificationInterface $specA,
        SpecificationInterface $specB,
        QueryBuilder $qb,
        Expr $expr
    )
    {
        $alias = 'r';

        $this->beConstructedWith($specA, $specB);

        $specA->match($qb, $alias)->shouldBeCalled()->willReturn($qb);
        $specB->match($qb, $alias)->shouldBeCalled()->willReturn($qb);
        $qb->expr()->shouldBeCalled()->willReturn($expr);
        $expr->orX(Argument::cetera())->shouldBeCalled();

        $this->match($qb, $alias);
    }
}
