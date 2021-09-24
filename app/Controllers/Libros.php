<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;

class Libros extends Controller {

    public function index(){

        $libro = new Libro();
        $datos['titulo'] = array('titulo' => 'Servicios - ColdTruck Solutions, S.A. - Panamá');
        $datos['cabecera'] = view('plantilla/cabecera');
        $datos['pie'] = view('plantilla/pie');
        $datos['libros'] = $libro->orderby('id', 'ASC')->findAll();
        return view('libros/listar', $datos);
    }

    public function crear(){
        $datos['cabecera'] = view('plantilla/cabecera');
        $datos['pie'] = view('plantilla/pie');
        return view('libros/crear', $datos);
    }

    public function guardar(){

        $libro = new Libro();

        // Validacion Imagen
        $validacion = $this->validate([
            'nombre' => 'required|min_length[3]',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]'
            ]
        ]);

        // Si la validación falla
        if(!$validacion){
            $session = session();
            $session->setFlashdata('mensaje', 'Revise la información');
            return redirect()->back()->withInput();
        }

        //$nombre = $this->request->getVar('nombre');

        if($imagen = $this->request->getFile('imagen')){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('../public/img/', $nuevoNombre);
            $datos = [
                'nombre' => $this->request->getVar('nombre'),
                'imagen' => $nuevoNombre
            ];
            $libro->insert($datos); // Guarda los datos en la BD
            
            return $this->response->redirect(site_url('/listar'));
        }
    }

    public function editar($id = null)
    {
        $libro = new Libro();
        $datos['libro'] = $libro->where('id', $id)->first();

        $datos['cabecera'] = view('plantilla/cabecera');
        $datos['pie'] = view('plantilla/pie');

        return view('libros/editar', $datos);

    }

    public function actualizar()
    {
        $libro = new Libro();
        $datos = [
            'nombre' => $this->request->getVar('nombre')
        ];
        $id = $this->request->getVar('id');

        $validacion = $this->validate([
            'nombre' => 'required|min_length[3]',
        ]);

        // Si la validación falla
        if(!$validacion){
            $session = session();
            $session->setFlashdata('mensaje', 'Revise la información');
            return redirect()->back()->withInput();
        }

        $libro->update($id, $datos); // Actualizar registro

        // Validacion Imagen
        $validacion = $this->validate([
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]'
            ]
        ]);

        if($validacion){
            if($imagen = $this->request->getFile('imagen')){

                // Borra la imagen vieja
                $datosLibro = $libro->where('id', $id)->first();
                $ruta = ('../public/img/'.$datosLibro['imagen']);
                unlink($ruta); // Borra el archivo desde la ruta

                $nuevoNombre = $imagen->getRandomName();
                $imagen->move('../public/img/', $nuevoNombre);
                $datos = [
                    'imagen' => $nuevoNombre
                ];
                $libro->update($id, $datos); // Guarda los datos en la BD                
            }
        }
        return $this->response->redirect(site_url('/listar'));

    }

    public function borrar($id = null)
    {
        $libro = new Libro();
        $datosLibro = $libro->where('id', $id)->first();

        $ruta = ('../public/img/'.$datosLibro['imagen']);
        unlink($ruta); // Borra el archivo desde la ruta

        $libro->where('id', $id)->delete($id);
        
        return $this->response->redirect(site_url('/listar'));
    }
}