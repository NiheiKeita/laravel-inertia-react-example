import { Meta, StoryObj } from '@storybook/react-vite'
import { expect, userEvent, within } from 'storybook/test'
import { PlanSelector } from '.'
import { useState } from 'react'

const meta: Meta<typeof PlanSelector> = {
    title: 'components/PlanSelector',
    component: PlanSelector,
    tags: ['autodocs'],
}
export default meta

type Story = StoryObj<typeof meta>

const list = [
    'あああ',
    'Vue',
    'Angular',
    'Svelte',
    'Ember',
    'Preact'
]
export const Default: Story = {
    render() {
        const [data, setData] = useState("")
        return (
            <PlanSelector
                items={list}
                value={data}
                onChange={(v) => setData(v)}
            />
        )
    },
}

// フォーカス → ドロップダウン展開 → 項目クリックの一連のインタラクション
// （handleFocus / handleClick / handleBlur を実行させてカバレッジを上げる）
export const Interactive: Story = {
    render() {
        const [data, setData] = useState("")
        return (
            <PlanSelector
                items={list}
                value={data}
                onChange={(v) => setData(v)}
            />
        )
    },
    play: async ({ canvasElement }) => {
        const canvas = within(canvasElement)
        const input = canvas.getByPlaceholderText('Select an option...')

        // フォーカス → handleFocus 発火 → ドロップダウン展開
        await userEvent.click(input)
        await expect(canvas.getByText('Vue')).toBeInTheDocument()

        // 項目クリック → handleClick 発火（onMouseDown 経由）
        const item = canvas.getByText('Angular')
        await userEvent.pointer({ keys: '[MouseLeft>]', target: item })
    },
}

// 空の配列 → "No items found" 分岐をカバー
export const Empty: Story = {
    render() {
        const [data, setData] = useState("")
        return (
            <PlanSelector
                items={[]}
                value={data}
                onChange={(v) => setData(v)}
            />
        )
    },
    play: async ({ canvasElement }) => {
        const canvas = within(canvasElement)
        const input = canvas.getByPlaceholderText('Select an option...')
        await userEvent.click(input)
        await expect(canvas.getByText('No items found')).toBeInTheDocument()
    },
}
