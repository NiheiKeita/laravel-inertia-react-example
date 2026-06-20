# Conventions

- New React pages/components use directory form: `<Name>/index.tsx`, mandatory `<Name>/index.stories.tsx`, optional `hooks.ts`.
- Reusable React components are named exports and wrapped with `React.memo`; Inertia pages may default export.
- TypeScript prop shapes use `type Props = { ... }`; avoid `interface` and `any` unless justified with a comment.
- Frontend styling is Tailwind only; no CSS-in-JS. Form/data flow uses Inertia `useForm`/`router`, not ad-hoc axios calls.
- Laravel controllers stay thin; validation in FormRequest, formatting in Resource, business logic in Services.
- New Services use constructor DI, readonly properties where appropriate, interface dependencies, and no `app()`/`resolve()` service lookup.
- Prefer repository/domain layering for new backend code; avoid Model direct access from Controllers/Services when adding new behavior.
- Comments should explain WHY, not restate WHAT.