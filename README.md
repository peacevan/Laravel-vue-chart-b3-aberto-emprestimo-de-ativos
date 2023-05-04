# Laravel-vue-chart-b3-aberto-emprestimo-de-ativos
Dados: arquivo de Posições em Aberto de Empréstimo de Ativos - https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/


- Dados: arquivo de Posições em Aberto de Empréstimo de Ativos - https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/
- Um comando Artisan para baixar dados  da B3 através de um Job (queue), e salvar os dados no banco de dados. Necessário salvar os valores de múltiplos dias.
Implemente algum teste unitário no PHP se encontrar alguma possibilidade
- Uma página para exibir os dados com pelo menos um gráfico relacionado usando Vue.js. Ideia: ter um Dropdown para escolher um ativo e ao selecioná-lo exibir um gráfico mostrando a evolução da quantidade de saldo do ativo e do preço médio.



#Instalação do Projeto 
entrar na pasta  backend 

php composer install
php artisan  serve
comando para estrair os dados do Site.

´php artisan import-data-b3´ 

Comando para  executar o FrontEnd 

Entrar na pasta frontend e executar 
 npm run serve
