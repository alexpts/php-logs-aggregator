# Logs Aggregator

[![Build Status](https://travis-ci.org/alexpts/php-logs-aggregator.svg?branch=master)](https://travis-ci.org/alexpts/php-logs-aggregator)
[![Code Coverage](https://scrutinizer-ci.com/g/alexpts/php-logs-aggregator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alexpts/php-logs-aggregator/?branch=master)
[![Code Climate](https://codeclimate.com/github/alexpts/php-logs-aggregator/badges/gpa.svg)](https://codeclimate.com/github/alexpts/php-logs-aggregator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alexpts/php-logs-aggregator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alexpts/php-logs-aggregator/?branch=master)


Container for PSR-3 logs

## Installation

```$ composer require alexpts/php-logs-aggregator```


### Example

```php
<?php
use PTS\LogsAggregator\LogsAggregator;

$logger = new LogsAggregator;

$logger->emergency('Message 1');
$logger->alert('DB not avaible', ['node' => '127.0.0.1']);
$logger->critical('Permission denied', ['userId' => 1, 'uri' => '/admin/settings']);
$logger->error('Some error');
...

$logs = $logger->getRecords();
$logger->reset();

```