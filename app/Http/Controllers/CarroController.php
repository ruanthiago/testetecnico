<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\User;
use DOMDocument;
use DOMElement;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('carros.index', [
            /* Buscando os registros */
            'cars' => Carro::all()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request:
     * @return \Illuminate\Http\Response
     */
    public function capturar(Request $request)
    {
        try {
            /* Buscando o conteudo html */
            $content = file_get_contents("https://www.questmultimarcas.com.br/estoque?termo={$request->search}");

            /* Instancia a bilbioteca */
            $dom = new DOMDocument();

            /* Convertendo o conteudo html */
            @$dom->loadHTML($content);

            /* Buscando o container pincipal */
            $container = $dom->getElementById('pixad-listing');

            /* Buscando os artigos */
            $articles = $container->getElementsByTagName('article');

            /* Array de inserção de dados */
            $insert = [];

            /* Percorrendo os artigos, e setando os dados */
            foreach ($articles as $article) {
                $insert[] = [
                    'user_id'       => auth()->user()->id,
                    'nome_veiculo'  => trim($this->getElementsByClass($article, 'h2', 'card__title')[0]->getElementsByTagName('a')[0]->textContent),
                    'link'          => trim($this->getElementsByClass($article, 'h2', 'card__title')[0]->getElementsByTagName('a')[0]->getAttribute('href')),
                    'ano'           => trim($this->getElementsByClass($article, 'ul', 'card__list')[0]->getElementsByTagName('li')[0]->getElementsByTagName('span')[1]->textContent),
                    'quilometragem' => trim($this->getElementsByClass($article, 'ul', 'card__list')[0]->getElementsByTagName('li')[1]->getElementsByTagName('span')[1]->textContent),
                    'combustivel'   => trim($this->getElementsByClass($article, 'ul', 'card__list')[0]->getElementsByTagName('li')[2]->getElementsByTagName('span')[1]->textContent),
                    'cambio'        => trim($this->getElementsByClass($article, 'ul', 'card__list')[0]->getElementsByTagName('li')[3]->getElementsByTagName('span')[1]->textContent),
                    'portas'        => trim($this->getElementsByClass($article, 'ul', 'card__list')[0]->getElementsByTagName('li')[4]->getElementsByTagName('span')[1]->textContent),
                    'cor'           => trim($this->getElementsByClass($article, 'ul', 'card__list')[0]->getElementsByTagName('li')[5]->getElementsByTagName('span')[1]->textContent),
                    'preco'         => trim(str_replace('R$', '', $this->getElementsByClass($article, 'span', 'card__price-number')[0]->textContent)),
                ];
            }

            /* Inserindo os registros */
            Carro::insert($insert);

            /* Retornando para a listagem */
            Session::flash('flash_success', 'Os dados foram importados com sucesso!');
            return redirect()->route('carros');

        } catch (\Throwable $th) {
            Session::flash('flash_error', 'Não foi possivel importar os dados!');
            return redirect()->route('carros');
        }
    }

    /**
     * Retorna os elementos que batem com a class passada por parametro
     *
     * @param DOMElement $parentNode: Elemento que contem os childs
     * @param string $tagName: Tag que será procurada
     * @param string $className: Classe que deve conter na tag a ser procurada
     * @return array
     *
     * @version 1.0.0
     * @author Ruan Thiago <ruanthiagocardoso@gmail.com>
     */
    private function getElementsByClass(DOMElement $parentNode, string $tagName, string $className): array
    {
        /* Array de retorno */
        $nodes = [];

        /* Buscando as tags que batem com a passada por parametro */
        $matchs = $parentNode->getElementsByTagName($tagName);

        /* Percorrendo os resultados */
        foreach ($matchs as $tag) {
            /* Validando se dentro do attr class existe o termo passado por parametro */
            if (stripos($tag->getAttribute('class'), $className) !== false) {
                $nodes[] = $tag;
            }
        }

        return $nodes;
    }

    /**
     * Exclui um registro
     *
     * @param int $id: ID do registro
     *
     * @version 1.0.0
     * @author Ruan Thiago <ruanthiagocardoso@gmail.com>
     */
    public function delete(int $id)
    {
        try {
            /* Excluindo o registro */
            Carro::find($id)->delete();

            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger'], 500);
        }
    }
}
