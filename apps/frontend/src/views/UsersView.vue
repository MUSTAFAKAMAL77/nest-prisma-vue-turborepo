<template>
  <div class="users-view">
    <h1>Users Management</h1>

    <div class="actions">
      <button @click="showCreateForm = true" class="btn-primary">Add New User</button>
    </div>

    <div v-if="userStore.error" class="error">
      {{ userStore.error }}
    </div>

    <div v-if="userStore.loading" class="loading">Loading...</div>

    <table v-else class="users-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in userStore.users" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ new Date(user.createdAt).toLocaleDateString() }}</td>
          <td>
            <button @click="editUser(user)" class="btn-secondary">Edit</button>
            <button @click="deleteUser(user.id)" class="btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Create/Edit Form Modal -->
    <div v-if="showCreateForm || editingUser" class="modal">
      <div class="modal-content">
        <h2>{{ editingUser ? 'Edit User' : 'Create User' }}</h2>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label>Name:</label>
            <input v-model="formData.name" type="text" required />
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input v-model="formData.email" type="email" required />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-primary">
              {{ editingUser ? 'Update' : 'Create' }}
            </button>
            <button type="button" @click="closeForm" class="btn-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useUserStore } from '../stores/user.store';
import type { User } from '@repo/types';

const userStore = useUserStore();
const showCreateForm = ref(false);
const editingUser = ref<User | null>(null);
const formData = ref({ name: '', email: '' });

onMounted(() => {
  userStore.fetchUsers();
});

function editUser(user: User) {
  editingUser.value = user;
  formData.value = { name: user.name, email: user.email };
}

async function submitForm() {
  try {
    if (editingUser.value) {
      await userStore.updateUser(editingUser.value.id, formData.value);
    } else {
      await userStore.createUser(formData.value);
    }
    closeForm();
  } catch (error) {
    console.error('Form submission error:', error);
  }
}

async function deleteUser(id: string) {
  if (confirm('Are you sure you want to delete this user?')) {
    await userStore.deleteUser(id);
  }
}

function closeForm() {
  showCreateForm.value = false;
  editingUser.value = null;
  formData.value = { name: '', email: '' };
}
</script>

<style scoped>
.users-view {
  padding: 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
  margin-bottom: 2rem;
}

.actions {
  margin-bottom: 1rem;
}

.error {
  background: #fee;
  color: #c00;
  padding: 1rem;
  border-radius: 4px;
  margin-bottom: 1rem;
}

.loading {
  text-align: center;
  padding: 2rem;
}

.users-table {
  width: 100%;
  border-collapse: collapse;
}

.users-table th,
.users-table td {
  padding: 0.75rem;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.users-table th {
  background: #f5f5f5;
  font-weight: 600;
}

button {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 0.5rem;
}

.btn-primary {
  background: #42b983;
  color: white;
}

.btn-secondary {
  background: #666;
  color: white;
}

.btn-danger {
  background: #c00;
  color: white;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  min-width: 400px;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
}

.form-group input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.form-actions {
  display: flex;
  gap: 0.5rem;
  margin-top: 1.5rem;
}
</style>
