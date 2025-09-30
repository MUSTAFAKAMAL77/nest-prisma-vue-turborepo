import { defineStore } from 'pinia';
import type { User, CreateUserDto, UpdateUserDto } from '@repo/types';
import { usersService } from '../services/users.service';

interface UserState {
  users: User[];
  loading: boolean;
  error: string | null;
}

export const useUserStore = defineStore('user', {
  state: (): UserState => ({
    users: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchUsers() {
      this.loading = true;
      this.error = null;
      try {
        const response = await usersService.getAll();
        this.users = response.data;
      } catch (error) {
        this.error = error instanceof Error ? error.message : 'Failed to fetch users';
      } finally {
        this.loading = false;
      }
    },

    async createUser(data: CreateUserDto) {
      this.loading = true;
      this.error = null;
      try {
        const response = await usersService.create(data);
        this.users.push(response.data);
      } catch (error) {
        this.error = error instanceof Error ? error.message : 'Failed to create user';
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async updateUser(id: string, data: UpdateUserDto) {
      this.loading = true;
      this.error = null;
      try {
        const response = await usersService.update(id, data);
        const index = this.users.findIndex((u) => u.id === id);
        if (index !== -1) {
          this.users[index] = response.data;
        }
      } catch (error) {
        this.error = error instanceof Error ? error.message : 'Failed to update user';
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async deleteUser(id: string) {
      this.loading = true;
      this.error = null;
      try {
        await usersService.delete(id);
        this.users = this.users.filter((u) => u.id !== id);
      } catch (error) {
        this.error = error instanceof Error ? error.message : 'Failed to delete user';
        throw error;
      } finally {
        this.loading = false;
      }
    },
  },
});
