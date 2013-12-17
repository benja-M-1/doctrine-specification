doctrine-specification
======================

Implementation of the Specification pattern with Doctrine2.

This library is greatly inspired by Benjamin Eberlei's [blog post](http://www.whitewashing.de/2013/03/04/doctrine_repositories.html).

The first I read about the specification pattern I was sceptic: "Oh man! It's too complicated, there might be a simpler
solution..." And I'm not the only one according to the comments! Then I tried this solution and I had to admit that it
brings flexibility into your repository. Now you can use this library as a starting point for your project to use the
specification pattern.

Usage
=====

```php

$spec = new AndX(
    new MySpecA(),
    new MySpecB()
);

$matcher = new Matcher();

$query = $matcher->match($em->getRepository('Foo\Bar'), 'r', $spec);

$results = $query->getResults();
```

TODO
====

[ ] Specification generator
[ ] Dynamic specification creation