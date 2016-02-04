**Programming task**

  Implement function diff to find changed values in two JSON objects. You can use any
  programming language but no external libraries allowed. Consider the performance of your
  implementation while keeping your code elegant. Provide code, tests and the instructions to run
  them.


**Requirements**

  You will need php command-line interpreter installed. Tu install it on ubuntu please exec `apt-get install php5-cli`
  For other systems please look at http://php.net/manual/en/install.php

**How to run**
  - download/clone project
  - exec `php composer.phar install --no-dev` to bootstrap application (no external libraries, check composer.json)
  - exec `php scripts/json_diff.php`

**How to run unit tests**
  - exec `php composer.phar install` to download codeception test suit
  - exec `./vendor/bin/codecept run unit`

  You may need to install php5-curl for codeception on some systems (exec `apt-get install php5-curl` on ubuntu)

**Data structure and patterns**

  I've choose to introduce Tree-kind ValueObject named Tree to store and operate data.
  Every Tree object stores set of key-values, values could be primitives or objects of Tree class, which reflects subtrees.
  Every Tree object contains Hash value, which dependent on Tree values and will be used for objects compare.

  Next, I've created TreeDiff comparator. It contains diff() method, which recieves two Tree objects.
  The diff() method returns new Tree object which represents the difference between arguments.

  It's implemented as an iteration throw the values of Tree objects, comparing values (Hashes are used at this point)
  and filling the result object. If the iterator detects subtree at a some point, it will recursively compares subtrees.

  I could not specify any specific patterns apart of DI/IC, which leads my solution at this point, but I tried to follow the SOLID principle.
  I've created some set of unit tests (one of them is actually an acceptance from my point).
