import { Test, TestingModule } from '@nestjs/testing';
import { UsersService } from './users.service';
import { PrismaService } from '../prisma/prisma.service';
import type { User, CreateUserDto, UpdateUserDto } from '@repo/types';

describe('UsersService', () => {
  let service: UsersService;
  let prisma: PrismaService;

  const mockUser: User = {
    id: '123e4567-e89b-12d3-a456-426614174000',
    email: 'test@example.com',
    name: 'Test User',
    createdAt: new Date('2024-01-01'),
    updatedAt: new Date('2024-01-01'),
  };

  const mockPrismaService = {
    user: {
      findMany: jest.fn(),
      findUnique: jest.fn(),
      create: jest.fn(),
      update: jest.fn(),
      delete: jest.fn(),
    },
  };

  beforeEach(async () => {
    const module: TestingModule = await Test.createTestingModule({
      providers: [
        UsersService,
        {
          provide: PrismaService,
          useValue: mockPrismaService,
        },
      ],
    }).compile();

    service = module.get<UsersService>(UsersService);
    prisma = module.get<PrismaService>(PrismaService);

    // Clear all mocks before each test
    jest.clearAllMocks();
  });

  it('should be defined', () => {
    expect(service).toBeDefined();
  });

  describe('findAll', () => {
    it('should return an array of users', async () => {
      const users = [mockUser];
      mockPrismaService.user.findMany.mockResolvedValue(users);

      const result = await service.findAll();

      expect(result).toEqual(users);
      expect(prisma.user.findMany).toHaveBeenCalledTimes(1);
    });

    it('should return empty array when no users exist', async () => {
      mockPrismaService.user.findMany.mockResolvedValue([]);

      const result = await service.findAll();

      expect(result).toEqual([]);
      expect(prisma.user.findMany).toHaveBeenCalledTimes(1);
    });

    it('should handle database errors', async () => {
      mockPrismaService.user.findMany.mockRejectedValue(new Error('Database error'));

      await expect(service.findAll()).rejects.toThrow('Database error');
    });
  });

  describe('findOne', () => {
    it('should return a user by id', async () => {
      mockPrismaService.user.findUnique.mockResolvedValue(mockUser);

      const result = await service.findOne(mockUser.id);

      expect(result).toEqual(mockUser);
      expect(prisma.user.findUnique).toHaveBeenCalledWith({
        where: { id: mockUser.id },
      });
    });

    it('should return null when user not found', async () => {
      mockPrismaService.user.findUnique.mockResolvedValue(null);

      const result = await service.findOne('nonexistent-id');

      expect(result).toBeNull();
      expect(prisma.user.findUnique).toHaveBeenCalledWith({
        where: { id: 'nonexistent-id' },
      });
    });

    it('should handle database errors', async () => {
      mockPrismaService.user.findUnique.mockRejectedValue(new Error('Database error'));

      await expect(service.findOne(mockUser.id)).rejects.toThrow('Database error');
    });
  });

  describe('create', () => {
    it('should create a new user', async () => {
      const createDto: CreateUserDto = {
        email: 'new@example.com',
        name: 'New User',
      };

      const newUser = { ...mockUser, ...createDto };
      mockPrismaService.user.create.mockResolvedValue(newUser);

      const result = await service.create(createDto);

      expect(result).toEqual(newUser);
      expect(prisma.user.create).toHaveBeenCalledWith({
        data: createDto,
      });
    });

    it('should handle duplicate email errors', async () => {
      const createDto: CreateUserDto = {
        email: 'duplicate@example.com',
        name: 'Duplicate User',
      };

      mockPrismaService.user.create.mockRejectedValue({
        code: 'P2002',
        meta: { target: ['email'] },
      });

      await expect(service.create(createDto)).rejects.toMatchObject({
        code: 'P2002',
      });
    });

    it('should validate email format', async () => {
      const createDto: CreateUserDto = {
        email: 'valid@example.com',
        name: 'Valid User',
      };

      mockPrismaService.user.create.mockResolvedValue({
        ...mockUser,
        ...createDto,
      });

      const result = await service.create(createDto);

      expect(result.email).toBe(createDto.email);
    });
  });

  describe('update', () => {
    it('should update a user successfully', async () => {
      const updateDto: UpdateUserDto = {
        name: 'Updated Name',
      };

      const updatedUser = { ...mockUser, ...updateDto };
      mockPrismaService.user.update.mockResolvedValue(updatedUser);

      const result = await service.update(mockUser.id, updateDto);

      expect(result).toEqual(updatedUser);
      expect(prisma.user.update).toHaveBeenCalledWith({
        where: { id: mockUser.id },
        data: updateDto,
      });
    });

    it('should allow partial updates', async () => {
      const updateDto: UpdateUserDto = {
        email: 'updated@example.com',
      };

      const updatedUser = { ...mockUser, ...updateDto };
      mockPrismaService.user.update.mockResolvedValue(updatedUser);

      const result = await service.update(mockUser.id, updateDto);

      expect(result.email).toBe(updateDto.email);
      expect(result.name).toBe(mockUser.name);
    });

    it('should handle update of non-existent user', async () => {
      const updateDto: UpdateUserDto = { name: 'New Name' };

      mockPrismaService.user.update.mockRejectedValue({
        code: 'P2025',
        meta: { cause: 'Record to update not found.' },
      });

      await expect(service.update('nonexistent-id', updateDto)).rejects.toMatchObject({
        code: 'P2025',
      });
    });
  });

  describe('remove', () => {
    it('should delete a user successfully', async () => {
      mockPrismaService.user.delete.mockResolvedValue(mockUser);

      const result = await service.remove(mockUser.id);

      expect(result).toEqual(mockUser);
      expect(prisma.user.delete).toHaveBeenCalledWith({
        where: { id: mockUser.id },
      });
    });

    it('should handle deletion of non-existent user', async () => {
      mockPrismaService.user.delete.mockRejectedValue({
        code: 'P2025',
        meta: { cause: 'Record to delete does not exist.' },
      });

      await expect(service.remove('nonexistent-id')).rejects.toMatchObject({
        code: 'P2025',
      });
    });

    it('should handle database errors during deletion', async () => {
      mockPrismaService.user.delete.mockRejectedValue(new Error('Database connection lost'));

      await expect(service.remove(mockUser.id)).rejects.toThrow('Database connection lost');
    });
  });
});
