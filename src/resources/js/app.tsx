import './bootstrap'
import '../css/app.css'

import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/react'
import type { ResolvedComponent } from '@inertiajs/react'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'
const pages = import.meta.glob<{ default: ResolvedComponent }>('./Pages/**/*.tsx')

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    title: (title) => `${title} ${appName}`,
    resolve: async (name) => (await resolvePageComponent(`./Pages/${name}/index.tsx`, pages)).default,
    setup({ el, App, props }) {
        const root = createRoot(el)

        root.render(<App {...props} />)
    },
    progress: {
        color: '#4B5563',
    },
})
