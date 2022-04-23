class Utils {

  static validarResponse(response) {
    if (response.status === 500) {
      alertify.alert("ERROR", "Ocurrio un error inesperado!, recargue el navegador o ponganse encontacto con el administrador");
      throw Error('Ocurrio un error inesperado!, recargue el navegador o ponganse encontacto con el administrador');
    }
  }

  static mostrarValidaciones(json, formulario) {
    let mensajes = '';

    if (typeof json.messages === 'object') {
      let messages = Object.values(json.messages);
      messages.forEach(error => {
        mensajes += error + '<br />';
      });
    } else {
      mensajes = json.messages;
    }

    $(formulario).find('.validaciones').html(`<div class="alert alert-danger text-center" role="alert">${mensajes}</div>`);
  }

  static obtenerFilaSeleccionada(dataTable, button) {
    let data = dataTable.row(button).data();
    if (jQuery.isEmptyObject(data)) {
      let tr = $(button).closest('tr');
      data = dataTable.row(tr).data();
    }

    return data;
  }

  static resetearFormulario(formulario, selects2 = null) {
    formulario.reset();
    formulario.querySelector('.validaciones').innerHTML = "";

    if (selects2 !== null) {
      selects2.forEach(select2 => {
        $(`${select2}`).val(null).trigger('change');
      });
    }
  }

  static establecerOpcionSelect2(select2, datosOpcion) {
    if ($(`${select2}`).find("option[value='" + datosOpcion.id + "']").length) {
      $(`${select2}`).val(datosOpcion.id).trigger('change');
    } else {
      let nuevaOpcion = new Option(datosOpcion.text, datosOpcion.id, true, true);
      $(`${select2}`).append(nuevaOpcion).trigger('change');
    }
  }

  static toggleSeccion(seccionTabla, seccionFrm) {
    if (window.getComputedStyle(seccionTabla).getPropertyValue('display') === 'block') {
      seccionTabla.style.display = "none";
      seccionFrm.style.display = "block";
    } else {
      seccionTabla.style.display = "block";
      seccionFrm.style.display = "none";
    }
  }

  static resaltarFila(tablaSelector, dataTable) {
    $(`#${tablaSelector} tbody`).on('click', 'tr', function () {
      if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
      }
      else {
        dataTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
    });
  }

  static llenarSelect(select, options, indice, _template = null) {
    let template = (_template !== null) ? _template : "";
    options.forEach(option => {
      template += `<option value="${option[indice.id]}">${option[indice.text]}</option>`
    });

    document.querySelector(`${select}`).innerHTML = template;
  }

  static calcularEdad(fecha) {
    let hoy = new Date();
    let cumpleanos = new Date(fecha);
    let edad = hoy.getFullYear() - cumpleanos.getFullYear();
    let m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
      edad--;
    }

    return (!isNaN(edad)) ? edad : "";
  }

  static filtrarPorId(datos, id) {
    let filtrado = datos.filter(function (dato) {
      return dato.id == id;
    });

    return filtrado[0];
  }

  static base64ToArrayBuffer(base64) {
    var binaryString = window.atob(base64);
    var binaryLen = binaryString.length;
    var bytes = new Uint8Array(binaryLen);
    for (var i = 0; i < binaryLen; i++) {
      var ascii = binaryString.charCodeAt(i);
      bytes[i] = ascii;
    }
    return bytes;
  }

  static saveByteArray(reportName, byte) {
    var blob = new Blob([byte], {
      type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
    });
    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    var fileName = reportName;
    link.download = fileName;
    link.click();
  };

  static readURL(input, result) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(`${result}`)
          .attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  static getDateForDateInput(dateString) {
    let date = new Date(dateString);
    let fecha = new Date(date.getTime() - (date.getTimezoneOffset() * 60000))
      .toISOString()
      .split("T")[0];
    return fecha;
  }

  static addDaysToDate(date, days) {
    date.setDate(date.getDate() + days);
    return date;
  }
}