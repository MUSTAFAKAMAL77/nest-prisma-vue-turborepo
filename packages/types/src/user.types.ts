// User entity types
export interface User {
  id: string;
  email: string;
  name: string;
  createdAt: Date;
  updatedAt: Date;
}

// User DTOs
export interface CreateUserDto {
  email: string;
  name: string;
}

export interface UpdateUserDto {
  email?: string;
  name?: string;
}

// API Response types
export interface UserResponse {
  data: User;
  message?: string;
}

export interface UsersResponse {
  data: User[];
  total: number;
  message?: string;
}
