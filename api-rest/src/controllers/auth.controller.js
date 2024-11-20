import bcrypt from "bcrypt";
import jwt from "jsonwebtoken";
import { ClinicModel } from "../models/clinic.model.js";

export class AuthController {
  static async login(req, res) {
    const { clinicName, password } = req.body;

    if (!clinicName || !password) {
      return res.status(400).json({ message: "Missing required fields" });
    }

    try {
      const clinic = ClinicModel.getClinic(clinicName);

      const clientPassword = clinic.senha;
      const clientId = clinic.id;

      if (!clientPassword) {
        return res.status(404).json({ message: "Clinic not found" });
      }

      const passwordMatch = bcrypt.compareSync(password, clientPassword);

      if (!passwordMatch) {
        return res.status(401).json({ message: "Invalid clinic or password" });
      }

      const token = jwt.sign({ clinicName, clientId }, "SECRET", {
        expiresIn: "1h",
      });

      return res.status(200).json({ message: "Login successful", clinica: clinicName, idClinica: clientId, token });
    } catch (error) {
      return res
        .status(500)
        .json({ message: "Internal server error", error: error.message });
    }
  }
}
