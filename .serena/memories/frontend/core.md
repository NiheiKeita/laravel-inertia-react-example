# Frontend Core

- Frontend root: `src/resources/js`; Inertia pages under `Pages/Admin` and `Pages/Web`, shared UI under `Components`, layouts under `Layouts`, hooks under `hooks`, types under `types`.
- Tooling config lives in `src/vite.config.js`, `src/eslint.config.js`, `src/tsconfig.json`, `src/.storybook/`.
- `src/package.json` scripts: `dev`, `build` (`tsc && vite build`), `storybook`, `lint`, `lint:fix`, `type-check`, `build-storybook`, `test-storybook`, `test-storybook:watch`.
- Storybook stories use `tags: ['autodocs']`; use `tags: ['!test']` only for components that cannot run under Vitest/Storybook tests.