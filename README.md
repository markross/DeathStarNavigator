# DeathStarNavigator

Clone the repository and install with composer as follows:

`composer install`

Config is stored in config.json and has 3 settings. The defaults are provided and should work.

- `uri` The URI of the API
- `name` The name to use when querying the api
- `tunnel_length` The length of the tunnel

Note that it is assumed the length of the tunnel is known.

## Running the app

Run the app as follows:

`php run.php`

## Running the tests

To run tests run:

`./vendor/bin/phpspec run`
