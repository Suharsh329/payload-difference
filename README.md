# payload-difference

## Requirements
```bash
PHP 8.1
[Composer](https://getcomposer.org/)
```

## Installation
```bash
git clone git@github.com:Suharsh329/payload-difference.git

cd payload-difference

composer install
```

## Run
```bash
php artisan serve --port=<PORT>

Create post request in Postman
```

## Test
```bash
php artisan test
```

### Task
- The comparison of the two payloads is based on Set Difference. Assuming A is the first request payload and B is the second request payload, then the difference is A \ B. This returns the values in A not in B.
- The function compares successive requests i.e. request 1 -> request 2, request 2 -> request 3
- I wrote a middleware to validate the request, just to separate the logic
- I have written a feature test to test the middleware



### Improvements
- Write an in-depth function to compare the payloads, something like a git diff.
- Create a docker image to run instead of deploying locally.
