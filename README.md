# web-frontend

## Installation

Install the PHP dependencies using [composer](https://getcomposer.org/).

```sh
composer install
```

Create an initialization file `rabbitmq.ini` which contains RabbitMQ credentials separated into sections. Only one section is needed for database communication. For example:

```ini
[database]
host = localhost
port = 5672
user = guest
password = guest
vhost = /
```

## Database Integration

A design constraint of this project was to isolate the database from the webserver. Instead of issuing SQL queries directly to the database, the webserver makes indirect requests through RabbitMQ.

Suppose that the database server provides a function `login` that takes as parameters a username and password. The following code would access `login` indirectly, just like calling any other function.

```php
$db_client = new DatabaseRpcClient();
$db_client->call("login", $username, $password); // example
```

This design pattern is known as *remote procedure calling* (RPC). The files [`rpc_client.php`](include/rpc_client.php) and [`rpc_server.php`](sample/rpc_server.php) were adapted from this official [RabbitMQ tutorial](https://www.rabbitmq.com/tutorials/tutorial-six-php.html).
