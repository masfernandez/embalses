# Embalses de Paquito

Read the instructions at [here](https://github.com/masfernandez/embalses/doc/kata_objectives.pdf)

## How to install dependencies?
At project's root execute:
````
composer install
````

## How to run this script?
At project's root execute:
````
php src/embalses_de_paquito.php
````

At this point the program waits for the data by the standard input:

```
7
10 1
1 2 1 0 3 1 2 2 1 2
6 2
2 1 4 3 0 2
3 4
0 1 0
4 1
0 2 3 1
4 2
2 1 0 1
10 3
1 2 0 1 3 0 2 0 1 2
20 5
31 12 11 34 30 45 0 5 21 29 17 30 26 4 18 23 15 27 9 11
```

And press enter... Results will be printed at standard output when finish. 

## How to run the test suite?
At project's root execute:
````
vendor/bin/phpunit tests
````
