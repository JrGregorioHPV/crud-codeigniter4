<?php
namespace App\Models;

use CodeIgniter\Model;

class Libro extends Model{
    protected $table = 'libros'; // Nombre de la tabla
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'imagen']; // Activar acceso a las columnas
}