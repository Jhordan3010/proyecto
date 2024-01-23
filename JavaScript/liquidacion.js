function calcularLiquidacion() {
    const sueldoMensual = parseFloat(document.getElementById('sueldo-empleado').value);
    const antiguedad = parseInt(document.getElementById('antiguedad').value);
    const diasVacacionesNoTomadas = parseInt(document.getElementById('dias_vacaciones').value);

    // Realizar el cálculo de la liquidación
    const salarioAnual = sueldoMensual * 12;
    const salarioDiario = salarioAnual / 365;

    const indemnizacionAntiguedad = salarioDiario * 15 * antiguedad;
    const compensacionVacaciones = salarioDiario * diasVacacionesNoTomadas;

    const liquidacionTotal = indemnizacionAntiguedad + compensacionVacaciones;

    // Mostrar el resultado en la etiqueta correspondiente
    const resultadoLiquidacion = document.getElementById('resultado-liquidacion');
    resultadoLiquidacion.innerHTML = 'Liquidación estimada: $' + liquidacionTotal.toFixed(2);
}
