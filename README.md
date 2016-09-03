# CLog - A class for logging timestamps
A logging class written as part of a web programming course. Can easily be used with the Anax web framework.

The class CLog can be used to identify which parts of your PHP code are running slowly.

## Use of CLog
Create a new CLog instance (optionally setting the decimal precision in the constructor). Then make timestamps in your code where you want to identify how fast/slowly your code is running. Finally, present your results as a table with the built in function timestampAsTable or fetch information about the timestamps with some of the other supplied methods.

The webroot folder contains an example file of how to use CLog in more detail.

## Integrating CLog in Anax MVC
To integrate CLog with Anax MVC simple add the following line in your "required" part of the composer.json file.
```
"ultimadark/logger": "dev-master"
```

Then update your composer dependencies by running `composer update` in your Anax MVC folder. The CLog class will be autoloaded if you want to create a new CLog object.

The easiest way to make your CLog object available during development is to load it as a service in your CDIFactoryDefault file (in the src/DI folder) like this:

```php
$this->setShared('logger', function () {
    $logger = new \ultimadark\Logger\CLog();
    return $logger;
});
```

The logger can then be accessed like any other loaded service.

