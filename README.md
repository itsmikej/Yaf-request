
Yaf request class encapsulation
===========================

Installation
------------
`imj\yaf-request` dependent on [imj\filter](https://github.com/itsmikej/Filter)
```shell
composer require imj\yaf-request
```

Basic Usage
------------

```php
use Imj\Filter;
use Imj\YafRequest;

$request = new YafRequest();
$foo = $request->get('foo', Filter::STRING_TYPE);
$bar = $request->post('bar', Filter::INT_TYPE, ['min'=>1]);
$baz = $request->request('baz', Filter::STRING_TYPE);
$fbb = $request->cookie('fbb', Filter::STRING_TYPE);
```

License
------------

licensed under the MIT License - see the `LICENSE` file for details
