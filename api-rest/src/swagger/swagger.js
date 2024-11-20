import swaggerJsdoc from "swagger-jsdoc";
import swaggerUi from "swagger-ui-express";

const options = {
  swaggerDefinition: {
    openapi: "3.0.0", // versão do OpenAPI
    info: {
      title: "Minha API", // Título da API
      version: "1.0.0", // Versão da API
      description: "Documentação da minha API", // Descrição da API
    },
    servers: [
      {
        url: "http://localhost:3000", // URL do servidor da API
      },
    ],
  },
  apis: ["./src/routes/*.js"], // Caminho para os arquivos de rota
};

// Gerando a documentação a partir dos comentários no código
const specs = swaggerJsdoc(options);

export { swaggerUi, specs };
