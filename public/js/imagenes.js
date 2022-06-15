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

  const firebaseConfig = {
    //Configuracion Firebase
    apiKey: 'AIzaSyBxTWaOS4fNHAsmTHEHobSlRTSZrnvmpRI',
    authDomain: 'proyecto-integrado-84f84.firebaseapp.com',
    databaseURL:
      'https://proyecto-integrado-84f84-default-rtdb.europe-west1.firebasedatabase.app',
    projectId: 'proyecto-integrado-84f84',
    storageBucket: 'proyecto-integrado-84f84.appspot.com',
    messagingSenderId: '912037766332',
    appId: '1:912037766332:web:e40f6dd6a892048b771cb9',
  }

  if (!firebase.apps.length) {
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig)
  } else {
    firebase.app() // if already initialized, use that one
  }

  let db = firebase.firestore() //Guardar conexion firebase en variable

  //Se guardan los datos del formulario
  data.push($('#dataForm').find('input[name="id"]').val())
  data.push($('#dataForm').find('input[name="nameUser"]').val())
  data.push($('#dataForm').find('input[name="emailUsuario"]').val())
  data.push(document.getElementById('comentUsuario').value) //El textarea hay que seleccionarle de esta forma el valueº

  const tiempoTranscurrido = Date.now();
  const hoy = new Date(tiempoTranscurrido)

  //Añadir comentario al firebase
  db.collection('comentarios')
    .add({
      id: data[0],
      nombre: data[1],
      email: data[2],
      comentario: data[3],
      fechaServer: hoy.toUTCString(), // "Sat, 13 Jun 2020 18:30:00 GMT"
      fechaComent: hoy.toLocaleDateString(), // "14/6/2020"

    })
    .then((ref) => {
      console.log('Documento añadido con ID: ', ref.id)
      location.reload();
    })
  console.log(data)
}

function traerComentarios(idImg) {
  const firebaseConfig = {
    //Configuracion Firebase
    apiKey: 'AIzaSyBxTWaOS4fNHAsmTHEHobSlRTSZrnvmpRI',
    authDomain: 'proyecto-integrado-84f84.firebaseapp.com',
    databaseURL:
      'https://proyecto-integrado-84f84-default-rtdb.europe-west1.firebasedatabase.app',
    projectId: 'proyecto-integrado-84f84',
    storageBucket: 'proyecto-integrado-84f84.appspot.com',
    messagingSenderId: '912037766332',
    appId: '1:912037766332:web:e40f6dd6a892048b771cb9',
  }

  if (!firebase.apps.length) {
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig)
  } else {
    firebase.app() // if already initialized, use that one
  }

  let db = firebase.firestore() //Guardar conexion firebase en variable
  db.collection('comentarios')
    .where('id', '==', idImg)
    .get()
    .then((querySnapshot) => {
      querySnapshot.forEach((doc) => {
        // doc.data() is never undefined for query doc snapshots
        console.log(doc.id, ' => ', doc.data())

        // Generamos un div guardado en una variable comentario
        const comentario = document.createElement("div");
        comentario.innerHTML = //Asignamos a la variable comentario una estructura HTML
        "<div>"+
        "<h4>"+doc.data()["nombre"]+"</h4>"+doc.data()["fechaComent"]+
        "</div>"+
        "<p>"+doc.data()["comentario"]+"</p>";

        //Añadir comentario a la seccion de comentarios
        const sectioncomentarios = document.getElementById("seccionComentarios")
        sectioncomentarios.appendChild(comentario)
      })
    })
    .catch((error) => {
      console.log('Error getting documents: ', error)
    })
}
//Funcion de busqueda
var form = $('#myForm')
form.submit(function (e) {
  e.preventDefault()
  var query = $('#search').val()
  window.location.href = '/?query=' + query
})