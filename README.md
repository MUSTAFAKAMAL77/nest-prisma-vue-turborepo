# Fullstack Starter Template

A modern fullstack starter template featuring NestJS, Prisma, Vue 3, and Turborepo.

## Stack

- **Monorepo**: [Turborepo](https://turbo.build/repo)
- **Backend**: [NestJS](https://nestjs.com/) + [Prisma](https://www.prisma.io/)
- **Frontend**: [Vue 3](https://vuejs.org/) + [Vite](https://vitejs.dev/)
- **Shared**: TypeScript types package
- **Language**: TypeScript throughout

## Project Structure

```
├── apps/
│   ├── backend/          # NestJS API server
│   │   ├── src/
│   │   ├── prisma/       # Prisma schema & migrations
│   │   └── test/
│   └── frontend/         # Vue 3 application
│       ├── src/
│       │   ├── router/   # Vue Router
│       │   ├── stores/   # Pinia stores
│       │   ├── services/ # API services
│       │   ├── views/    # Page components
│       │   └── components/
├── packages/
│   └── types/            # Shared TypeScript types
└── turbo.json            # Turborepo config
```

## Prerequisites

- Node.js >= 18.0.0
- npm >= 9.0.0
- PostgreSQL database

## Getting Started

### 1. Install Dependencies

```bash
npm install
```

### 2. Set Up Environment Variables

**Backend** (`apps/backend/.env`):

```bash
cp apps/backend/.env.example apps/backend/.env
```

Edit `apps/backend/.env` and set your database URL:

```
DATABASE_URL="postgresql://user:password@localhost:5432/mydb?schema=public"
PORT=3000
NODE_ENV=development
```

**Frontend** (`apps/frontend/.env`):

```bash
cp apps/frontend/.env.example apps/frontend/.env
```

### 3. Initialize Database

```bash
cd apps/backend
npm run prisma:migrate
npm run prisma:seed  # Optional: seed sample data
```

### 4. Build Shared Packages

```bash
# From root
npm run build
```

### 5. Start Development Servers

```bash
# From root - starts all apps in parallel
npm run dev
```

Or start individually:

```bash
# Backend (http://localhost:3000)
cd apps/backend
npm run dev

# Frontend (http://localhost:5173)
cd apps/frontend
npm run dev
```

## Available Scripts

### Root Commands

- `npm run dev` - Start all apps in development mode
- `npm run build` - Build all apps for production
- `npm run lint` - Lint all apps
- `npm run format` - Format code with Prettier
- `npm run clean` - Clean all build outputs

### Backend Commands

- `npm run dev` - Start in watch mode
- `npm run build` - Build for production
- `npm run start` - Start production server
- `npm run prisma:migrate` - Run database migrations
- `npm run prisma:generate` - Generate Prisma Client
- `npm run prisma:studio` - Open Prisma Studio
- `npm run prisma:seed` - Seed database
- `npm run lint` - Lint code
- `npm run test` - Run tests

### Frontend Commands

- `npm run dev` - Start dev server
- `npm run build` - Build for production
- `npm run clean` - Clean build output

## Project Features

### Backend Features

- ✅ Clean architecture with controllers, services, and DTOs
- ✅ Prisma ORM with migrations
- ✅ Global validation with class-validator
- ✅ CORS enabled
- ✅ Global `/api` prefix
- ✅ Sample User model
- ✅ Database seeding

### Frontend Features

- ✅ Vue 3 with Composition API
- ✅ TypeScript support
- ✅ Vue Router for navigation
- ✅ Pinia for state management
- ✅ Axios for API calls
- ✅ Vite for fast builds

### Shared Features

- ✅ Shared TypeScript types
- ✅ Type-safe API contracts
- ✅ Monorepo with Turborepo caching

## Development Workflow

### Adding a New API Endpoint

1. Define types in `packages/types/src/`
2. Create Prisma model in `apps/backend/prisma/schema.prisma`
3. Generate Prisma Client: `npm run prisma:generate`
4. Create NestJS module/controller/service in `apps/backend/src/`
5. Use types from `@repo/types`

### Adding a New Frontend Page

1. Create view in `apps/frontend/src/views/`
2. Add route in `apps/frontend/src/router/index.ts`
3. Create service in `apps/frontend/src/services/` if needed
4. Use types from `@repo/types`

## Database Migrations

```bash
# Create a new migration
cd apps/backend
npm run prisma:migrate

# View database in Prisma Studio
npm run prisma:studio

# Reset database (WARNING: deletes all data)
npx prisma migrate reset
```

## Building for Production

```bash
# Build all packages
npm run build

# Backend will be in apps/backend/dist
# Frontend will be in apps/frontend/dist
```

## Troubleshooting

### Port Already in Use

Change the port in `apps/backend/.env`:

```
PORT=3001
```

### Database Connection Failed

Ensure PostgreSQL is running and the `DATABASE_URL` in `.env` is correct.

### Types Not Found

Build the types package:

```bash
cd packages/types
npm run build
```

## Next Steps

- [ ] Add authentication (JWT/sessions)
- [ ] Add API documentation (Swagger)
- [ ] Add Docker Compose setup
- [ ] Add E2E tests
- [ ] Add CI/CD pipeline
- [ ] Add error handling middleware
- [ ] Add logging

## License

MIT
