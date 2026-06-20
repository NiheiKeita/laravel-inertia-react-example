# Core

- Monorepo root wraps Docker/infra; application code lives under `src/`.
- Root `AGENTS.md` is authoritative for agents; it also includes external rules from `/Users/niheikeita/.codex/RTK.md`.
- `src/` contains Laravel app, React/Inertia frontend, MSW mocks, PHPUnit tests, Storybook config.
- Root commands mainly orchestrate Docker (`make up`, `make bash`, `make stop`, `make ps`); most dev/test commands run from `src/`.
- Read frontend specifics in `mem:frontend/core`; backend specifics in `mem:backend/core`; completion checks in `mem:task_completion`.