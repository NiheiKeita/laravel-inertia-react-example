import { describe, expect, it } from 'vitest'
import { yieldRate } from './yieldRate'

describe('yieldRate', () => {
    it('年間純利益 / 譲渡価格 × 100 を返す', () => {
        expect(yieldRate(100, 1000)).toBe(10)
        expect(yieldRate(50, 200)).toBe(25)
    })

    it('利益0 のときは 0 を返す', () => {
        expect(yieldRate(0, 1000)).toBe(0)
    })

    it('annualNetProfit が undefined のときは undefined を返す', () => {
        expect(yieldRate(undefined, 1000)).toBeUndefined()
    })

    it('transferPrice が undefined のときは undefined を返す', () => {
        expect(yieldRate(100, undefined)).toBeUndefined()
    })

    it('両方 undefined のときは undefined を返す', () => {
        expect(yieldRate(undefined, undefined)).toBeUndefined()
    })
})
