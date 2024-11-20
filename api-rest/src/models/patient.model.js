import { database } from "../db/db.connection.js";

export class PatientModel {
  static getPatientByCpf(patientCpf) {
    let patient = database
      .prepare(`SELECT * FROM pacientes WHERE cpf = '${patientCpf}'`)
      .get();

    patient = Object.assign({}, patient);

    return patient;
  }

  static getPatientExams(patientId) {
    let exams = database
      .prepare(
        `SELECT e.tipo_exame, e.resultado, e.data, e.id_medico, m.nome, m.crm, m.especialidade, m.email FROM exames e JOIN medicos m ON m.id_medico = e.id_medico WHERE e.id_paciente = ${patientId}`
      )
      .all();

    return exams;
  }

  static getPatientPrescriptions(patientId) {
    let prescriptions = database
      .prepare(
        `SELECT p.descricao, p.data, p.id_medico, m.nome, m.crm, m.especialidade, m.email FROM prescricoes p JOIN medicos m ON m.id_medico = p.id_medico WHERE p.id_paciente = ${patientId}`
      )
      .all();

    return prescriptions;
  }

  static getPatientDiagnostics(patientId) {
    let diagnostics = database
      .prepare(
        `SELECT d.descricao, d.data, d.id_medico, m.nome, m.crm, m.especialidade, m.email FROM diagnosticos d JOIN medicos m ON m.id_medico = d.id_medico WHERE d.id_paciente = ${patientId}`
      )
      .all();

    return diagnostics;
  }
}
