import { describe, expect, it } from 'vitest'
import { formatCreatedAt, formatCreatedAtLong, formatNumber, formatPrice } from './format'

describe('formatPrice', () => {
    it('数値を「円」付きカンマ区切りで返す', () => {
        expect(formatPrice(1000)).toBe('1,000円')
        expect(formatPrice(1234567)).toBe('1,234,567円')
    })

    it('0 円も正しく扱う', () => {
        expect(formatPrice(0)).toBe('0円')
    })

    it('undefined のときは空文字を返す', () => {
        expect(formatPrice(undefined)).toBe('')
    })
})

describe('formatNumber', () => {
    it('数値をカンマ区切りで返す（円なし）', () => {
        expect(formatNumber(1000)).toBe('1,000')
        expect(formatNumber(1234567)).toBe('1,234,567')
    })

    it('0 は "0" を返す', () => {
        expect(formatNumber(0)).toBe('0')
    })

    it('undefined のときは空文字を返す', () => {
        expect(formatNumber(undefined)).toBe('')
    })
})

describe('formatCreatedAt', () => {
    it('日付を YYYY-MM-DD 形式（ハイフン）で返す', () => {
        const date = new Date('2026-04-26T12:00:00')
        expect(formatCreatedAt(date)).toBe('2026-04-26')
    })

    it('1月1日のような小さい数字も 2 桁で返す', () => {
        const date = new Date('2025-01-01T00:00:00')
        expect(formatCreatedAt(date)).toBe('2025-01-01')
    })
})

describe('formatCreatedAtLong', () => {
    it('日付を日本語ロング形式で返す', () => {
        const date = new Date('2026-04-26T12:00:00')
        // ja-JP の long 形式: "2026年4月26日"
        expect(formatCreatedAtLong(date)).toContain('2026')
        expect(formatCreatedAtLong(date)).toContain('4')
        expect(formatCreatedAtLong(date)).toContain('26')
    })
})
