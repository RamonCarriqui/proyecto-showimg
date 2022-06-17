//Funcion de busqueda
var form = $('#myForm')
form.submit(function (e) {
  e.preventDefault()
  var query = $('#search').val()
  window.location.href = '/?query=' + query
})
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

  const tiempoTranscurrido = Date.now()
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
      location.reload()
    })
  console.log(data)
}

function traerInfoImg(idImg, emailUser) {
  //------Conf e inicio de Firebase
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
  //--------End Conf e inicio de Firebase

  //---Traer comentario----//
  db.collection('comentarios')
    .where('id', '==', idImg)
    .get()
    .then((querySnapshot) => {
      querySnapshot.forEach((doc) => {
        // doc.data() is never undefined for query doc snapshots
        console.log(doc.id, ' => ', doc.data())

        // Generamos un div guardado en una variable comentario
        const comentario = document.createElement('div')
        comentario.innerHTML = //Asignamos a la variable comentario una estructura HTML
          '<div>' +
          '<h4>' +
          doc.data()['nombre'] +
          '</h4>' +
          doc.data()['fechaComent'] +
          '</div>' +
          '<p>' +
          doc.data()['comentario'] +
          '</p>'

        //Añadir comentario a la seccion de comentarios
        const sectioncomentarios = document.getElementById('seccionComentarios')
        sectioncomentarios.appendChild(comentario)
      })
    })
    .catch((error) => {
      console.log('Error getting documents: ', error)
    })
  //---End Traer Comentarios----//

  //---Comprobar anadirFavorito----//
  var añadidoFav = false
  const botonAnFav = document.getElementById('anadirFav')
  const botonQuitarFav = document.getElementById('quitarFav')

  db.collection('favoritos')
    .where('email', '==', emailUser)
    .where('id', '==', idImg)
    .get()
    .then((querySnapshot) => {
      console.log(querySnapshot)
      if (querySnapshot.docs != 0) {
        añadidoFav = true
      }
      // console.log(idImg)
      if (añadidoFav) {
        //Si esta añadido se seleccionan los botones con el ID|| Añadir esta hidden y Quitar Fav esta visible
        botonAnFav.style.display = 'none'
        botonQuitarFav.style.display = 'block'
      } else {
        //Si esta añadido se seleccionan los botones con el ID|| Añadir esta visible y Quitar Fav esta hidden
        botonAnFav.style.display = 'block'
        botonQuitarFav.style.display = 'none'
      }
    })

  //---End Comprobar anadirFavorito----//
}

function anadirFav(src, nombreImg) {
  //------Conf e inicio de Firebase
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
  //--------End Conf e inicio de Firebase

  var data = []
  //Se guardan los datos del formulario
  data.push($('#dataForm').find('input[name="id"]').val())
  data.push($('#dataForm').find('input[name="emailUsuario"]').val())
  data.push(src)
  data.push(nombreImg)

  //Añadir comentario al firebase
  db.collection('favoritos')
    .add({
      id: data[0],
      email: data[1],
      src: data[2],
      nombreImg: data[3],
    })
    .then((ref) => {
      console.log('Añadido a favoritos la imagen con ID: ', ref.id)
      location.reload()
    })
  console.log(data)
}

function quitarFav(idImg, emailUser) {
  //------Conf e inicio de Firebase
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
  //--------End Conf e inicio de Firebase

  const favorito = db
    .collection('favoritos')
    .where('email', '==', emailUser)
    .where('id', '==', idImg)
  favorito
    .get()
    .then(function (querySnapshot) {
      querySnapshot.forEach(function (doc) {
        doc.ref.delete()
        console.log('Document successfully deleted!')
        location.reload()
      })
    })
    .catch((error) => {
      console.error('Error removing document: ', error)
    })
}

function traerFavs(emailUser) {
  //------Conf e inicio de Firebase
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
  //--------End Conf e inicio de Firebase

  //---Traer comentario----//
  db.collection('favoritos')
    .where('email', '==', emailUser)
    .get()
    .then((querySnapshot) => {
      querySnapshot.forEach((doc) => {
        // doc.data() is never undefined for query doc snapshots
        console.log(doc.id, ' => ', doc.data())
        // Generamos un div guardado en una variable comentario
        const id = doc.data()["id"]
        const email = doc.data()["email"]
        const src = doc.data()["src"]
        const nombreImg = doc.data()["nombreImg"]
        const favorito = document.createElement('div')
        const imgDownload = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M19 9h-4V3H9v6H5l7 8zM4 19h16v2H4z"></path></svg>`
        const imgQuitFav = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793z"></path></svg>`
        favorito.innerHTML = //Asignamos a la variable comentario una estructura HTML
          `<div class="imagenFav">
            <p>${nombreImg}</p>
            <img src=${doc.data()['src']}>`+
            `<div class="opciones">
              <button onclick="downloadImage('${src}','${nombreImg}')">Descargar ${imgDownload} </button>`+
              `<button onclick="quitarFav('${id}','${email}')">Quitar de favoritos ${imgQuitFav}</button>
            </div>
          </div>`
        //Añadir comentario a la seccion de comentarios
        const sectionFavs = document.getElementById('imgFav')
        sectionFavs.appendChild(favorito)
      })
    })
    .catch((error) => {
      console.log('Error getting documents: ', error)
    })
  //---End Traer Comentarios----//
}
