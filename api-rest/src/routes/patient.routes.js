import { Router } from "express";
import { PatientController } from "../controllers/patient.controller.js";

const router = Router();

router.get("/medical-record", PatientController.medicalRecords);

export { router as patientRoutes };
