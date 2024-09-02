<?php
namespace App\Http\Controllers\Api;
use App\Models\Login;
use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class ConsultaFilmeAPIController extends BaseAPIController{
    public function ConsultarFilme(Request $request){
        $dados = $request->all();

        $titulo = $dados['titulo'];
        $ano = $dados['ano'];
        $apiKey = 'c162901d';
        $url = "http://www.omdbapi.com/?apikey={$apiKey}&s={$titulo}&y={$ano}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $filmes = json_decode($response, true);
        if(isset($filmes['Error'])){
           return BaseRetornoApi::GetRetornoErro(['Filme não encontrado!']);
        }
        return $filmes;
    }
    
}
