<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\View\Component;
use SebastianBergmann\Environment\Console;
use Session;


class ImageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
  
  public function index()
  {
    //
    $expiresAt = new \DateTime('tomorrow');
    $imageReference = app('firebase.storage')->getBucket()->object("Images/defT5uT7SDu9K5RFtIdl.png");
    
    if ($imageReference->exists()) {
      $image = $imageReference->signedUrl($expiresAt);
    } else {
      $image = null;
    }
    
    return view('img', compact('image'));
  }
  public function enviarPhoto(Request $request) // Envia los datos a la vista de la imagen en concreto para maquetar
  {
    //
    $uid = Session::get('uid');
    $user = app('firebase.auth')->getUser($uid);
    $data = $request->all();
    // $json = file_get_contents('php://input');
    
    
    
    
    // echo " HOla :) <br><br>";
    // var_dump(json_decode($data['photo']));//Se hace decode al $data[photo] para obtener de nuevo el objeto en formato JSON
    $photo = json_decode($data['photo']);
    
    return view('imagen')
    ->with([
      'id' => $photo->{'id'},
      'nombre' => $photo->{'alt'},
      'avg_color' => $photo->{'avg_color'},
      'width' => $photo->{'width'},
      'height' => $photo->{'height'},
      'photographer' => $photo->{'photographer'},
      'src' => $photo->{'src'}->{'large2x'},
    ]);
  }
  // public function enviarComentario(Request $request) // Envia el comentario escrito por el usuario a Firestore
  // {
  //   $comentario = $request->all(); // Comentario contiene email de usuario y mensaje escribido, asi como los datos necesarios para la vista
  //   // PASO INTERMEDIO DE SUBIDA DE DATOS A FIRESTORE
  //   // EJEMPLO A ADAPTAR:
  //   // let data = {
  //     //   name: 'Los Angeles',
  //     //   state: 'CA',
  //     //   country: 'USA'
  //     // };
      
  //     // // Add a new document in collection "cities" with ID 'LA'
  //     // let setDoc = db.collection('cities').doc('LA').set(data);
      
  //     $db = new FirestoreClient([
  //       'projectId' => 'proyecto-integrado-84f84', // Nombre del proyecto
  //   ]);

  //     $db->collection('comentarios')->document($comentario['id'])->set($comentario); // Se sube el comentario a Firestore
  //     return view('imagen')->with($comentario); // Se devuelve la vista anterior
      
      
  //   }
    
    /**
     * Show the form for creating a new resource.
     *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    $request->validate([
      'image' => 'required',
    ]);
    $input = $request->all();
    $image = $request->file('image'); //image file from frontend

    $student   = app('firebase.firestore')->database()->collection('Images')->document('defT5uT7SDu9K5RFtIdl');
    $firebase_storage_path = 'Images/';
    $name     = $student->id();
    $localfolder = public_path('firebase-temp-uploads') . '/';
    $extension = $image->getClientOriginalExtension();
    $file      = $name . '.' . $extension;
    if ($image->move($localfolder, $file)) {
      $uploadedfile = fopen($localfolder . $file, 'r');
      app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
      //will remove from local laravel folder
      unlink($localfolder . $file);
      Session::flash('message', 'Succesfully Uploaded');
    }
    return back()->withInput();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
    $imageDeleted = app('firebase.storage')->getBucket()->object("Images/defT5uT7SDu9K5RFtIdl.png")->delete();
    Session::flash('message', 'Image Deleted');
    return back()->withInput();
  }
}
