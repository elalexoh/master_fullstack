<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PruebasController extends Controller
{
    public function index()
    {
        $titulo = 'Animales';
        $animales = ['Perro', 'Gato', 'Tigre', 'Marsupilami'];
        //enviando datos en la vista
        return view('pruebas.index', array(
            'titulo' => $titulo,
            'animales' => $animales
        ));
    }
    public function testOrm()
    {
        /*$posts = Post::all();
        foreach ($posts as $post) {
            echo '<h1>' . $post->title . '</h1>';
            echo '<span style="color: grey;">' . $post->user->name . ' - ' . $post->category->name . '</span>';
            echo '<h1>' . $post->content . '</h1>';
            echo '<hr>';
        }*/
        $categories = Category::all();
        foreach ($categories as $category) {
            echo '<h1>' . $category->name . '</h1>';
            foreach ($category->posts as $post) {
                echo '<h2>' . $post->title . '</h2>';
                echo '<span style="color: grey;">' . $post->user->name . ' - ' . $post->category->name . '</span>';
                echo '<h3>' . $post->content . '</h3>';
                echo '<hr>';
            }
        }
        die();
    }
}
