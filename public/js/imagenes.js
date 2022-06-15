// Funcion que saca de manera aleatoria un valor y te cambia de localizacion pasando el valor por la URL
function aleatorio() {
  var myArray = [
    'fiesta',
    'atardecer',
    'musica',
    'deporte',
    'aleatorio',
    'colorido',
  ]
  var rand = ~~(Math.random() * myArray.length)
  var rValue = myArray[rand]
  window.location.href = '/?query=' + rValue
}

// Funcion para descargar imagenes
function downloadImage(url, name) {
  //FUERA
  fetch(url)
    .then((resp) => resp.blob())
    .then((blob) => {
      const url = window.URL.createObjectURL(blob)
      const a = document.createElement('a')
      a.style.display = 'none'
      a.href = url
      // El nombre del archivo que tu buscas
      a.download = name
      document.body.appendChild(a)
      a.click()
      window.URL.revokeObjectURL(url)
    })
    .catch(() => alert('Ha ocurrido un error, lo sentimos'))
}

function enviarComentario() {
    var data = [] //Variable para guardar datos del comentario

    const firebaseConfig = {//Configuracion Firebase
        apiKey: 'AIzaSyBxTWaOS4fNHAsmTHEHobSlRTSZrnvmpRI',
        authDomain: 'proyecto-integrado-84f84.firebaseapp.com',
        databaseURL: 'https://proyecto-integrado-84f84-default-rtdb.europe-west1.firebasedatabase.app',
        projectId: 'proyecto-integrado-84f84',
        storageBucket: 'proyecto-integrado-84f84.appspot.com',
        messagingSenderId: '912037766332',
        appId: '1:912037766332:web:e40f6dd6a892048b771cb9',
    }

    if (!firebase.apps.length) {// Initialize Firebase
      firebase.initializeApp(firebaseConfig);
   }else {
      firebase.app(); // if already initialized, use that one
   }

    let db = firebase.firestore(); //Guardar conexion firebase en variable

    //Se guardan los datos del formulario
    data.push($('#dataForm').find('input[name="id"]').val())
    data.push($('#dataForm').find('input[name="emailUsuario"]').val())
    data.push(document.getElementById('comentUsuario').value) //El textarea hay que seleccionarle de esta forma el valueº

    //Añadir comentario al firebase
    db.collection('comentarios').add({
            id: data[0],
            email: data[1],
            comentario: data[2],
        }).then((ref) => {
          console.log('Documento añadido con ID: ', ref.id)
        })
    console.log(data)
}

//Funcion de busqueda
var form = $('#myForm')
form.submit(function (e) {
  e.preventDefault()
  var query = $('#search').val()
  window.location.href = '/?query=' + query
})

//Window onload
