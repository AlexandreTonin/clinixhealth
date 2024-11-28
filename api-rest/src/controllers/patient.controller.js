import { PatientModel } from "../models/patient.model.js";

export class PatientController {
  static async medicalRecords(req, res) {
    const { patientCpf } = req.query;

    try {
      const patient = PatientModel.getPatientByCpf(patientCpf);

      if (!patient || Object.keys(patient).length === 0) {
        return res.status(404).json({ message: "Patient not found" });
      }

      const exams = PatientModel.getPatientExams(patient.id_paciente);

      const prescriptions = PatientModel.getPatientPrescriptions(
        patient.id_paciente
      );

      const diagnostics = PatientModel.getPatientDiagnostics(
        patient.id_paciente
      );

      patient.exames = exams;
      patient.prescricoes = prescriptions;
      patient.diagnosticos = diagnostics;

      return res.status(200).json({ paciente: patient });
    } catch (error) {
      res
        .status(500)
        .json({ message: "Internal server error", error: error.message });
    }
  }
}
