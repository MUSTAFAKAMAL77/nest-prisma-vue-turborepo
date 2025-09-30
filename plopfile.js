module.exports = function (plop) {
  // NestJS Module Generator
  plop.setGenerator('nest-module', {
    description: 'Generate a NestJS module with controller, service, and DTOs',
    prompts: [
      {
        type: 'input',
        name: 'name',
        message: 'Module name (e.g., users, products):',
      },
    ],
    actions: [
      // Create module directory
      {
        type: 'add',
        path: 'apps/backend/src/{{camelCase name}}/{{camelCase name}}.module.ts',
        templateFile: 'plop-templates/nest-module/module.hbs',
      },
      // Create controller
      {
        type: 'add',
        path: 'apps/backend/src/{{camelCase name}}/{{camelCase name}}.controller.ts',
        templateFile: 'plop-templates/nest-module/controller.hbs',
      },
      // Create service
      {
        type: 'add',
        path: 'apps/backend/src/{{camelCase name}}/{{camelCase name}}.service.ts',
        templateFile: 'plop-templates/nest-module/service.hbs',
      },
      // Create DTOs
      {
        type: 'add',
        path: 'apps/backend/src/{{camelCase name}}/dto/create-{{dashCase name}}.dto.ts',
        templateFile: 'plop-templates/nest-module/dto-create.hbs',
      },
      {
        type: 'add',
        path: 'apps/backend/src/{{camelCase name}}/dto/update-{{dashCase name}}.dto.ts',
        templateFile: 'plop-templates/nest-module/dto-update.hbs',
      },
    ],
  });

  // Vue Component Generator
  plop.setGenerator('vue-component', {
    description: 'Generate a Vue component',
    prompts: [
      {
        type: 'input',
        name: 'name',
        message: 'Component name (e.g., UserCard, ProductList):',
      },
      {
        type: 'list',
        name: 'type',
        message: 'Component type:',
        choices: ['component', 'view'],
        default: 'component',
      },
    ],
    actions: function (data) {
      const basePath =
        data.type === 'view' ? 'apps/frontend/src/views' : 'apps/frontend/src/components';

      return [
        {
          type: 'add',
          path: `${basePath}/{{pascalCase name}}.vue`,
          templateFile: 'plop-templates/vue-component/component.hbs',
        },
      ];
    },
  });

  // Add helper for PascalCase entity name
  plop.setHelper('pascalCase', function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
  });
};
