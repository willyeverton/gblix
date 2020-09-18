
Framework PHP Laravel - API RESTful com interações via console.

## Introdução

Através da internet temos várias APIs disponíveis, tanto para informações públicas, como informações privadas, e hoje elas são utilizadas para as mais diversas funções: Autenticação, Validação de Dados, Consulta e Cálculos de Preços, Realização de Pagamentos, Cruzamento de Informações e até para Machine Learning.

Para eito iremos utilizar uma API pública relacionada ao Studio Ghibli, a sua documentação está disponível na seguinte URL: [https://ghibliapi.herokuapp.com/](https://ghibliapi.herokuapp.com/)

Com ela iremos trabalhar com os blocos de informações de FILMES (FILMS) e PESSOAS (PEOPLE), todas outras informações podem ser ignoradas.

## DESENVOLVIMENTO

Usando a API informada desenvolvemos uma aplicação que tem dois formatos de execução:

- Comando Artisan, usando o seguinte nome: `api:crawl`
- Agendado via schedule do Laravel à cada duas horas

Esse crawler salva TODAS as informações básicas da API de filmes e seus respectivos personagens e formata ela em banco de dados, a estrutura do banco.
Informações salvas:

**Filme:**

- Nome do Filme
- Descrição do Filme
- Diretor
- Produtor
- Ano de Lançamento
- Pontuação Rotten Tomato
- Personagens

**Personagens:**

- Nome do Personagem
- Genero
- Idade
- Cor dos Olhos
- Cor do Cabelo

### API

buscando as informações disponíveis no banco de dados existe a rota GET  `/people` que:

retorna as seguintes colunas:
- Nome do Personagem
- Idade do Personagem
- Título do Filme
- Ano de Lançamento do Filme
- Pontuação Rotten Tomato

retorna os resultados baseado no parâmetro `fmt` ou `Header Accept`, onde:
-  html: Uma página HTML com a tabela
-  json: Estrutura JSON do resultado
-  csv: Um arquivo no formato CSV tabulado com ponto e vírgula (;

filtra a informação de alguma coluna usando o parâmetro `filter`

altera ordenação de alguma coluna usando o parâmetro `order`

altera a sequência da ordenação usando o parâmetro `sort`

### CONSIDERAÇÕES

O banco de dados criado via migration.

O sistema suporta Seed (utilizando Model Factory) para exemplificação da estrutura.

A aplicação possue Unit-testing nativo do Laravel para garantir que o Eloquent esteja persistindo corretamente as informações.

### GOSTAMOS

- Reutilização de código;
- Não reinventar a rota;
- Legibilidade e performance;
- Facades não são tão malvadas quanto parecem;
- Aplicação da Metodologia SOLID;
- Desenvolvimento usando Services/Repositories;    
- Utilização de pacotes já existentes para responsabilidades complexas e extensíveis, exemplos: Manipulação de Imagem, Geração de Arquivos, Requisições à servidor remoto.
