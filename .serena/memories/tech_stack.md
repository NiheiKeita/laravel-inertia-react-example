# Tech Stack

- Backend: PHP/Laravel app under `src/`; `composer.json` currently requires PHP `^8.3`, Laravel framework `^13.14`, Inertia Laravel `^3.0`, Sanctum, Ziggy, swagger-php.
- Frontend: React/Inertia/TypeScript app under `src/resources/js` using Vite, Tailwind CSS, Storybook, MSW.
- Package managers: npm with `package-lock.json` in root and `src/`; Composer with `src/composer.lock`.
- Testing/static checks: PHPUnit, PHPStan/Larastan, PHPCS, ESLint, TypeScript `tsc`, Vitest Storybook project with Playwright browser provider.
- Runtime/dev infra: Docker Compose services app/nginx/db/swagger; Makefile at root.