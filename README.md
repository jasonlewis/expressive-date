# Expressive Date

A fluent extension to PHPs DateTime class.

[![Build Status](https://travis-ci.org/jasonlewis/expressive-date.png?branch=master)](https://travis-ci.org/jasonlewis/expressive-date)

## Example

~~~~
<?php

$date = new ExpressiveDate;

$date->minusOneDay();

echo $date->getRelativeDate(); // 1 day ago

$date->addOneWeek();

echo $date->getShortDate(); // Jan 31, 2012
~~~~

## Documentation

Refer to the following guide on how to use Expressive Date.

[Using Expressive Date](http://jasonlewis.me/code/expressive-date)

## Copyright and License
Expressive Date was written by Jason Lewis. Expressive Date is released under the 2-clause BSD License. See the LICENSE file for details.

Copyright 2012 Jason Lewis