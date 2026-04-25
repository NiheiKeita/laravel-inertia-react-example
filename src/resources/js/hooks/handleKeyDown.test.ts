import { describe, expect, it, vi } from 'vitest'
import { handleKeyDown } from './handleKeyDown'

describe('handleKeyDown', () => {
    it('Enter キーで preventDefault が呼ばれる', () => {
        const preventDefault = vi.fn()
        handleKeyDown({ key: 'Enter', preventDefault })
        expect(preventDefault).toHaveBeenCalledOnce()
    })

    it('Enter 以外のキーでは preventDefault が呼ばれない', () => {
        const preventDefault = vi.fn()
        handleKeyDown({ key: 'a', preventDefault })
        handleKeyDown({ key: 'Tab', preventDefault })
        handleKeyDown({ key: 'Escape', preventDefault })
        expect(preventDefault).not.toHaveBeenCalled()
    })
})
