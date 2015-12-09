Expression Evaluator
====

I looked around so much to find an expression evaluator, and none of my findings supported logical and comparison operators.
I created this package from a gist I found. I will be writing a service provider for Laravel 5.1 soon.

`5 + 3 * 2`

11

`(1 > 2 AND 3 < 2) OR 1+2 == 3`

 0
  
 
 `(3 > 2) AND (3 < 5)`
 
 1


 `(1 > 2) OR (3 < 5)`
 
 1


 `(1 > 2) OR (6 > 5)`
 
 1


 `(1 > 2) OR (6 < 5)`
 
 0


 `1 + 2 == 3`
 
 1


 `2 < 1 + 2`
 
 2


 `(2 < 1) + 2`
 
 2

 `((2 < 1) + 2) == 2`
 
 1

 `-8/-2`
 
 4

 `-8/2`
 
 -4

 `-8/-2 + 15 * 1`
 
 19



Inspired by & developed upon https://gist.github.com/ircmaxell/1232629