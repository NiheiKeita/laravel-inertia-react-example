import { Meta, StoryObj } from '@storybook/react-vite'
import { UserList } from '.'
import { users as sampleUsers } from './sample'

const meta: Meta<typeof UserList> = {
  title: 'views/Admin/UserList',
  component: UserList,
  tags: ['autodocs'],
}
export default meta

type Story = StoryObj<typeof meta>

export const Empty: Story = {
  args: {
    users: [],
  },
}

export const WithUsers: Story = {
  args: {
    users: sampleUsers,
  },
}

export const WithFlashMessage: Story = {
  args: {
    users: sampleUsers,
    flash: { message: '登録が完了しました' },
  },
}
