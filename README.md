
Laravel-vue-chart-b3-aberto-lending-assets
Data: Asset Lending Open Positions file - https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/ public-data-of-listed-and-over-the-counter-products/

Data: Asset Lending Open Positions file - https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/ public-data-of-listed-and-over-the-counter-products/
An Artisan command to download data from B3 through a Job (queue), and save the data in the database. Need to save multi-day values. Implement some unit test in PHP if you find any possibilities
A page to display the data with at least one related graph using Vue.js. Idea: having a Dropdown to choose an asset and, when selecting it, display a graph showing the evolution of the amount of balance of the asset and the average price.



## Instalação do Projeto  backend
executar no banco de dados o script 
```
  database.sql 
```

- entrar na pasta  backend rodar o comando 
```
   php composer install
```
- Para rodar o projeto execute o comando :  
```
  php artisan  serve
```

- para exutar o job execute o seguinte comando:
```
  php artisan import-data-b3
```
## Frontend 
 instalar as depedencias :
 entra na pasta front-end esxecutar o seguinte comando:
 ```
 npm install
 ```
 - Rodar a aplicação:
  entrar na pasta front-end executar o comando:
 ``` 
  npm run server
 ```
  - acessar o endereço
http://localhost:8080/

