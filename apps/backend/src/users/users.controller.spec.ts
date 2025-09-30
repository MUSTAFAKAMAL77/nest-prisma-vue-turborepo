import { Test, TestingModule } from '@nestjs/testing';
import { NotFoundException } from '@nestjs/common';
import { UsersController } from './users.controller';
import { UsersService } from './users.service';
import type { User, CreateUserDto, UpdateUserDto } from '@repo/types';

describe('UsersController', () => {
  let controller: UsersController;
  let service: UsersService;

  const mockUser: User = {
    id: '123e4567-e89b-12d3-a456-426614174000',
    email: 'test@example.com',
    name: 'Test User',
    createdAt: new Date('2024-01-01'),
    updatedAt: new Date('2024-01-01'),
  };

  const mockUsersService = {
    findAll: jest.fn(),
    findOne: jest.fn(),
    create: jest.fn(),
    update: jest.fn(),
    remove: jest.fn(),
  };

  beforeEach(async () => {
    const module: TestingModule = await Test.createTestingModule({
      controllers: [UsersController],
      providers: [
        {
          provide: UsersService,
          useValue: mockUsersService,
        },
      ],
    }).compile();

    controller = module.get<UsersController>(UsersController);
    service = module.get<UsersService>(UsersService);

    jest.clearAllMocks();
  });

  it('should be defined', () => {
    expect(controller).toBeDefined();
  });

  describe('findAll', () => {
    it('should return an array of users', async () => {
      const users = [mockUser];
      mockUsersService.findAll.mockResolvedValue(users);

      const result = await controller.findAll();

      expect(result).toEqual(users);
      expect(service.findAll).toHaveBeenCalledTimes(1);
    });

    it('should return empty array when no users', async () => {
      mockUsersService.findAll.mockResolvedValue([]);

      const result = await controller.findAll();

      expect(result).toEqual([]);
    });
  });

  describe('findOne', () => {
    it('should return a user when found', async () => {
      mockUsersService.findOne.mockResolvedValue(mockUser);

      const result = await controller.findOne(mockUser.id);

      expect(result).toEqual(mockUser);
      expect(service.findOne).toHaveBeenCalledWith(mockUser.id);
    });

    it('should throw NotFoundException when user not found', async () => {
      mockUsersService.findOne.mockResolvedValue(null);

      await expect(controller.findOne('nonexistent-id')).rejects.toThrow(NotFoundException);
      await expect(controller.findOne('nonexistent-id')).rejects.toThrow(
        'User with ID nonexistent-id not found'
      );
    });
  });

  describe('create', () => {
    it('should create and return a new user', async () => {
      const createDto: CreateUserDto = {
        email: 'new@example.com',
        name: 'New User',
      };

      const newUser = { ...mockUser, ...createDto };
      mockUsersService.create.mockResolvedValue(newUser);

      const result = await controller.create(createDto);

      expect(result).toEqual(newUser);
      expect(service.create).toHaveBeenCalledWith(createDto);
    });

    it('should validate required fields', async () => {
      const createDto: CreateUserDto = {
        email: 'test@example.com',
        name: 'Test',
      };

      mockUsersService.create.mockResolvedValue({
        ...mockUser,
        ...createDto,
      });

      const result = await controller.create(createDto);

      expect(result.email).toBeDefined();
      expect(result.name).toBeDefined();
    });
  });

  describe('update', () => {
    it('should update and return the user', async () => {
      const updateDto: UpdateUserDto = {
        name: 'Updated Name',
      };

      const updatedUser = { ...mockUser, ...updateDto };
      mockUsersService.findOne.mockResolvedValue(mockUser);
      mockUsersService.update.mockResolvedValue(updatedUser);

      const result = await controller.update(mockUser.id, updateDto);

      expect(result).toEqual(updatedUser);
      expect(service.findOne).toHaveBeenCalledWith(mockUser.id);
      expect(service.update).toHaveBeenCalledWith(mockUser.id, updateDto);
    });

    it('should throw NotFoundException when user not found', async () => {
      const updateDto: UpdateUserDto = { name: 'Updated' };
      mockUsersService.findOne.mockResolvedValue(null);

      await expect(controller.update('nonexistent-id', updateDto)).rejects.toThrow(
        NotFoundException
      );
      expect(service.update).not.toHaveBeenCalled();
    });

    it('should check user existence before updating', async () => {
      const updateDto: UpdateUserDto = { email: 'updated@example.com' };
      mockUsersService.findOne.mockResolvedValue(mockUser);
      mockUsersService.update.mockResolvedValue({
        ...mockUser,
        ...updateDto,
      });

      await controller.update(mockUser.id, updateDto);

      expect(service.findOne).toHaveBeenCalled();
      expect(service.update).toHaveBeenCalled();
    });
  });

  describe('remove', () => {
    it('should delete and return the user', async () => {
      mockUsersService.findOne.mockResolvedValue(mockUser);
      mockUsersService.remove.mockResolvedValue(mockUser);

      const result = await controller.remove(mockUser.id);

      expect(result).toEqual(mockUser);
      expect(service.findOne).toHaveBeenCalledWith(mockUser.id);
      expect(service.remove).toHaveBeenCalledWith(mockUser.id);
    });

    it('should throw NotFoundException when user not found', async () => {
      mockUsersService.findOne.mockResolvedValue(null);

      await expect(controller.remove('nonexistent-id')).rejects.toThrow(NotFoundException);
      expect(service.remove).not.toHaveBeenCalled();
    });

    it('should check user existence before deleting', async () => {
      mockUsersService.findOne.mockResolvedValue(mockUser);
      mockUsersService.remove.mockResolvedValue(mockUser);

      await controller.remove(mockUser.id);

      expect(service.findOne).toHaveBeenCalled();
      expect(service.remove).toHaveBeenCalled();
    });
  });
});
