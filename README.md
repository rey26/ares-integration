# ARES Integration

This app retrieves and stores data from ARES API (Official source from Ministry of Finance of Czech republic) about companies. If a company is found via its Business ID (ico) in the local DB, its instance is returned. If the company is not in local DB, we look for it in ARES API and store company to local DB.
This App has REST API interface and simple UI available

## Installation

1. `composer install`
1. `php bin/console doctrine:database:create`
1. `php bin/console doctrine:migrations:migrate`

## Usage

Make sure that you have symfony executable installed on your local machine

1. run tests `php bin/phpunit`
1. start web server: `symfony serve`
1. open available [url](https://127.0.0.1:8000) in the browser
1. make an API call on [url](https://127.0.0.1:8000/api/company/123) and substitute '123' with Business id of a company resided in Czech republic.
