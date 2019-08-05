# Tour App API

The Below API are created
- `[GET] /tours` :: Get list of tours with min details.
- `[GET] /tours/{id/url}` :: Get detailed view of a tour with given id or slug/url.
- `[POST] /tours` :: Create a new product.
- `[PUT] /tours` :: Edit an existing product.
- `[DELETE] /tours/{id}` :: Delete a product with given id.

Follow the below steps to setup the project
- Copy .env.example to .env
`cp .env.example .env`
- Update the db config in .env (Use sqlite for now to run it quickly, if your not using docker)
- Run migrations
`php artisan migrate`
- Run database seeds
`php artisan db:seed`
- Run php server
`php artisan serve`

_Now you can browse your Tour app API in http://127.0.0.1:8000/tours_

# In prrogress
- Completing the testcases for API
- Completing the Docker setup
- Upgrading this documentation :)