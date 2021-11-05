# web-frontend

## Installation

Install the PHP dependencies using [composer](https://getcomposer.org/).

```sh
composer install
```

Create an initialization file `include/rabbitmq.ini` which contains your RabbitMQ credentials. For example:

```ini
[rabbitmq]
HOST="localhost"
PORT=5672
USER="guest"
PASSWORD="guest"
VHOST="/"
```

## Database Integration

A design constraint of this project was to isolate the database from the webserver. Instead of issuing SQL queries directly to the database, the webserver makes indirect requests through RabbitMQ.

Suppose that the database server provides a function `login` that takes as parameters a username and password. The following code would access `login` indirectly, just like calling any other function.

```php
$db_client = new DatabaseRpcClient();
$db_client->call("login", $username, $password); // example
```

This design pattern is known as *remote procedure calling* (RPC). The files [`rpc_client.php`](include/rpc_client.php) and [`rpc_server.php`](include/rpc_server.php) were adapted from this official [RabbitMQ tutorial](https://www.rabbitmq.com/tutorials/tutorial-six-php.html).
