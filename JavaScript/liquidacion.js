// Función para calcular la liquidación de un empleado
function calcularLiquidacion(salarioMensual, antiguedad, diasVacacionesNoTomadas) {
    // Definir constantes
    const salarioAnual = salarioMensual * 12;
    const salarioDiario = salarioAnual / 365;

    // Calcular la indemnización por antigüedad (ejemplo: 15 días por cada año)
    const indemnizacionAntiguedad = salarioDiario * 15 * antiguedad;

    // Calcular la compensación por días de vacaciones no tomadas
    const compensacionVacaciones = salarioDiario * diasVacacionesNoTomadas;

    // Sumar todos los componentes para obtener la liquidación total
    const liquidacionTotal = indemnizacionAntiguedad + compensacionVacaciones;

    return liquidacionTotal;
}

// Ejemplo de uso
const salarioMensual = 3000;
const antiguedad = 5;
const diasVacacionesNoTomadas = 10;

const liquidacion = calcularLiquidacion(salarioMensual, antiguedad, diasVacacionesNoTomadas);

console.log("La liquidación total es: $" + liquidacion);
