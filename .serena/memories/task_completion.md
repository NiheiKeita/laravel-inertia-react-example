# Task Completion

- For frontend dependency/config/code changes from `src/`, run at least `npm run type-check`, `npm run lint`, and relevant build/test command (`npm run build` and/or `npm run test-storybook`).
- For backend PHP changes from `src/`, run `composer phpcs .`, `vendor/bin/phpstan analyze`, and `vendor/bin/phpunit`.
- New React components/pages are not complete without Storybook stories.
- New Laravel Services are not complete without focused PHPUnit unit tests.
- Full PR checklist from project rules: PHP PHPCS/PHPStan/PHPUnit; frontend lint/type-check/build or Storybook tests as applicable; coverage awareness for substantial changes.