api_event
=========
### Requirement
* PHP 7
* PostgreSql
* Composer
* Import database file **api.sql**

### Installation

        git clone git@github.com:damienmoulin/event_api.git

        cd event_api/

        composer install

set parameters.yml

        parameters:
            db_host: 127.0.0.1
            db_port: 5432
            db_name: api_event
            db_user: guimauve
            db_password: FWQTtgTRS

Run server

        php bin/console server:run
