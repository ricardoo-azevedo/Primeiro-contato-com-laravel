<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* Route:: Requisição Http('primeiro parametro para endpoint', função(){corpo do metodo onde retornara uma view, onde se localizará na pasta views, tmb precisando identificar se esta dentro de alguma pasta});*/ 
Route::get('/empresa', function(){
    return view('site/empresa');
});

/*Não é muito comum pq não é seguro kkkkkk*/ 
Route::any('/any', function(){
    return ("Permite todo tipo de acesso http (put, delete, get, post)");
});

Route:: match(['get', 'post'],'/match', function(){
    return ('permite apenas acessos definidos no primeiro parametro antes do endpoint');
});

/*Usando parametros q vem na url, se usa atravez de chaves como no exemplo abaixo, apos voce inicia uma variavel no parametro da função pra automaticamente o valor do url ser passado pra a variavel, permitindo trabalhar com ela*/ /*se tu colocar uma interrogação apos o parametro do endpoint, tu não precisa mais obrigatoriamente colocar um valor para aquele parametro, mas tmb vai ter q colocar um valor padrão pra conseguir fazer isso*/ 
Route:: get('/produto/{id}/{categoria?}', function($id, $categoria = ""){
    return ("O Id do produto é: ".$id."<br>A categoria é: ".$categoria);
});

/*como redirencionar uma rota para a outra: colocando o redirect('a rota q vai servir como redirencionamento', 'pra onde o redirencionamento vai')*/
Route:: redirect('/sobre', '/empresa');

/*Redirecionamentos de rotas atraves dos nomes delas:
Abaixo da pra ver q é uma rota com o endpoint '/news' onde a mesma rota é direcionada para uma view de mesmo nome, porem da pra atribuir um name a essa rota para simplificar redirecionamentos*/
Route:: get('/news', function(){
    return view('news');
    /* abaixo percebe-se que antes do ponto e virgula da para se colocar um operador de acesso para uma função name que vai atribuir o nome da rota pelo que sta entre aspas*/
})->name("noticias");
/* aqui da pra ver uma rota com o endpoint '/novidades' onde sua função é redirecionar para a rota news se utilizando do seu nome q lhe foi dado*/
Route:: get('/novidades', function(){
    return redirect()->route('noticias');
});

/*========================================================================================================*/
/* aqui podemos observar uma criação de um grupo de rotas, onde utiliza o prefix 'admin' para localizar cada rota especifica dentro desse grupo, pois essa é uma maneira simplificada para acessar cada endpoint q tem /admin no começo*/
Route::prefix('admin')->group(function(){

    Route::get('dashboard', function(){
        return("dashboard");
    });
    
    Route::get('user', function(){
        return("user");
    });
    
    Route::get('clients', function(){
        return("clients");
    });
    
});

/*aqui é igual ao exemplo acima, mas todas as rotas do grupo possuem um nome atribuido, assim ao inves de usar o prefix como referencia, voce usa o name q cada rota é atribuida como referencia */
Route::name('admin.')->group(function(){

    Route::get('admin/dashboard', function(){
        return("dashboard");
    })->name("admin.dashboard");
    
    Route::get('admin/user', function(){
        return("user");
    })->name("admin.user");
    
    Route::get('admin/clients', function(){
        return("clients");
    })->name("admin.clients");
    
});










