
//    Cálculo dígito de verificación

function calcularDigitoVerificacion(nit) {

  const primos = [3, 7, 13, 17, 19, 23, 29, 37, 41, 43, 47, 53, 59];
  let digitosNit = nit.split("");
  let digitosNitRev = [];
  let sumatoria = 0;

  for (let i=digitosNit.length;i>0;i--) {
      digitosNitRev.push(digitosNit[i-1]);
  }

  for (let j=0;j<digitosNitRev.length;j++) {
      sumatoria += parseInt(digitosNitRev[j])*primos[j];
  }

  let mod = sumatoria % 11;
  let digit_verification = mod;

  if (mod>1) {
    digit_verification = 11 - mod;
  }

  if (isNaN(digit_verification)) {
      return '';
  }
  else {
      return digit_verification;
  }
}

document.addEventListener('DOMContentLoaded', function() {
  let nitInput = document.getElementById('identification_number1');
  let dvInput = document.getElementById('digit_verification1');

  nitInput.addEventListener('input', function() {
      let nit = nitInput.value;
      let isNitValid = nit >>> 0 === parseFloat(nit);

      if (isNitValid && nit.length >= 5) {
          let digit_verification = calcularDigitoVerificacion(nit);
          dvInput.value = digit_verification;
      } else {
          console.log("El NIT ingresado no es válido.");
          dvInput.value = "";
      }
  });
});



// Cierre cálculo dígito de verificación




