<?php
class CalculoMegaSena{
    private $qtdeDezenas = '';   
    private $resultado = '';   
    private $totalJogos = '';   
    private $jogos = '';   

    public function __construct($qtdeDezenas, $totalJogos){
        $this->setQtdeDezenas($qtdeDezenas);
        $this->setTotalJogos($totalJogos);
    }
    
    public function setQtdeDezenas($valor){
        $this->qtdeDezenas = $valor;
    }

    public function setResultado($valor){
        $this->resultado = $valor;
    }

    public function setTotalJogos($valor){
        $this->totalJogos = $valor;
    }
    
    public function setJogos($valor){
        $this->jogos = $valor;
    }

    public function getQtdeDezenas(){
        return $this->qtdeDezenas; 
    }
    
    public function getResultado(){
        return $this->resultado; 
    }
    
    public function getTotalJogos(){
        return $this->totalJogos; 
    }
    
    public function getJogos(){
        return $this->jogos; 
    }

    private function arrDezenasCrescente(){
        $arr = array();
        
        $i = 1;
        while( $i <= $this->qtdeDezenas ) {
            $numero = rand( 1,60 );
            if(!in_array( $numero,$arr)) {
                $arr[] = $numero;
                ++$i;
            }
        }
        sort($arr);
        
        return $arr;
    }

    public function qtdeJogos(){
        $cria_jogos = array();
        for ($i=0; $i < $this->totalJogos; $i++) { 
            $cria_jogos[] = $this->arrDezenasCrescente();
        }

        $this->setJogos($cria_jogos);
    }

    public function sorteio(){
        $arr = array();
        
        $i = 0;
        while( $i <= 5 ) {
            $numero = rand( 1,60 );
            if(!in_array( $numero,$arr)) {
                $arr[] = $numero;
                ++$i;
            }
        }
        sort($arr);

        $this->setResultado($arr);
    }

    public function retorno_html(){
        
        $this->qtdeJogos();
        $this->sorteio();

        if (in_array($this->getQtdeDezenas(), [6,7,8,9,10])) {

            $QuantidadeDezenas = $this->getQtdeDezenas();
            $Resultado = $this->getResultado();
            $TotalJogos = $this->getTotalJogos();
            $Jogos = $this->getJogos();

            $retorno = '<h2>Números Sorteados: '.implode(',', $Resultado).'</h2>';
            $retorno .= '<table border=1>';
            $retorno .= '<tr><th>Jogos</th>';
            $retorno .= '<th>Número de acertos</th></tr>';
            foreach ($Jogos as $jogo) {
                $retorno .= '<tr><td>'.implode(',', $jogo).'</td>';
                $acertos = array_intersect($Resultado, $jogo);
                $retorno .= '<td>'.count($acertos).'</td></tr>';
            }
            $retorno .= '</table>';

        }else{
            $retorno = 'Ops, somente é aceita dezenas de 6,7,8,9,10';
        }
        return $retorno;
    }
}