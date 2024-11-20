import { database } from "../db/db.connection.js";

export class ClinicModel {
  static getClinic(clinicName) {
    let clinic = database
      .prepare(`SELECT * FROM clientes_api WHERE clinica = '${clinicName}'`)
      .get();

    clinic = Object.assign({}, clinic);

    return clinic;
  }
}
