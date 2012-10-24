
# Sledgehammer Filters

Adds additional filters compatible with the \Sledgehammer\filter() function.

A filter is a [callable](http://php.net/manual/en/language.types.callable.php) that takes only 1 argument (as input) and returns the filterd output.

The buildin functions "addslashes" and "urlencode" for example are compatible with sledgehammer's filter "interface".

## Examples
```
$encoded = filter($myData, 'urlencode'); // Using a global function.

$db = new PDO('sqlite::memory:');
$quoted = filter($myData, array($db, 'quote')); // Using a function in a object/class.

$slug = filter($myData, new SlugFilter()); /// Using a object with an __invoke() method.

$filter = function ($data) { return substr($data, 0, 10); };
$truncated = filter($myData, $filter); // Using a closure.
```