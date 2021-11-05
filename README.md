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

## Acknowledgements

The remote procedure call (RPC) code was adapted from this official [RabbitMQ tutorial](https://www.rabbitmq.com/tutorials/tutorial-six-php.html).
