# Backend Core

- Laravel app root: `src/`; application namespace `App\`; tests namespace `Tests\`.
- Backend directories: controllers in `app/Http/Controllers/{Admin,Web}`, models in `app/Models`, services in `app/Services`, providers in `app/Providers`, tests in `tests/{Unit,Feature}`.
- Composer scripts: `composer phpcs` uses `./vendor/bin/phpcs --standard=phpcs.xml`; `composer phpcs-fix` uses phpcbf.
- PHP static/test tools configured by `src/phpstan.neon`, `src/phpunit.xml`, `src/phpcs.xml`.