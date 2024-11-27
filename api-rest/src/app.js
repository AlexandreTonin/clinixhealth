import express from "express";
import morgan from "morgan";
import { database } from "./db/db.connection.js";
import chalk from "chalk";
import { authRoutes } from "./routes/auth.routes.js";
import { patientRoutes } from "./routes/patient.routes.js";
import verifyAuth from "./middlewares/verifyAuth.js";
import { swaggerUi, specs } from "./swagger/swagger.js";
import fs from "fs";
import https from "https";

// const privateKey = fs.readFileSync("private-key.pem", "utf8");
// const certificate = fs.readFileSync("certificate.pem", "utf8");

const app = express();

app.use(express.json());
app.use(morgan("dev"));

app.use("/v1/auth", authRoutes);
app.use("/v1/patient", patientRoutes);

// Serve a documentação do Swagger na rota /api-docs
app.use("/v1/api-docs", swaggerUi.serve, swaggerUi.setup(specs));

app.get('/', (req, res) => {
  res.send('API de prontuários médicos');
});

// const server = https.createServer(
//   {
//     key: privateKey,
//     cert: certificate,
//   },
//   app
// );

// server.listen(3000, () => {
//   console.log(chalk.yellow("API is running on https://localhost:3000"));
// });

app.listen(3000, () => {
  console.log(chalk.yellow("API is running on http://localhost:3000"));
});