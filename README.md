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


**Data structure and patterns**

  I've choose to introduce Tree-kind ValueObject to parse json-encoded strings into. Tree Objects knows nothing about jsons, it's initialized from Array.
  Every Tree VO contains hash of values, values could be primitives or objects of TreeVO class, which reflects subtrees.
  Every TreeVO contains Hash, which dependent on Tree values and will be used for easy compare of subtrees.

  I've created Json VO which acts as facade and decorator in front of Tree VO to implement parsing from and to Json strings.
  I've decided to parse json's completely to simplify the task since expected size of json's was not reflected in the requirements.

  Next, I've created TreeDiff comparator, It iterates throw values of the second provided VO and fill result diff object with the values
  which differs from values in the first object. It iterator find subtrees as values og VO it recursively compares them using their Hashes.

