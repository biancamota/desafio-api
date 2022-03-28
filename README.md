

## Sobre

A API pública desenvolvida em PHP com Laravel que consome os dados de outra API externa https://api.reddit.com/r/artificial/hot salvando-os em uma base para posterior consulta através de dois endpoints.
É possível consultar as postagens em um determinado período de tempo e seus authores. 

## Utilização

### 🎲 Rodando o projeto

```bash
# Clone este repositório
$ git clone <git@github.com:biancamota/desafio-api.git>

# Acesse a pasta do projeto
$ cd desafio-api
```
Abra no seu editor de código, abra o arquivo env.example, edite com as suas configurações de ambiente e salve com .env
![image](https://user-images.githubusercontent.com/12559964/160451010-2fc84217-572f-4034-92c6-a9f5e57b8d24.png)

```bash
# Rode as migrations
$ php artisan migrate

# Execute a aplicação 
$ php artisan serve

# O servidor inciará na porta:8000 - acesse <http://127.0.0.1:8000>
```
## Chamando a api

### posts

![image](https://user-images.githubusercontent.com/12559964/160456195-cb9e30c9-2736-41ee-aa25-6f794ad08f02.png)

Retorna as postagens criadas dentro do período informado em ordem decrescente seguindo a ordenação estipulada

<table>
  <thead>
    <tr>
      <th>Atributo</th>
      <th>Tipo</th>
      <th>Obrigatoriedade</th>
      <th>Descrição</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>initial_date</th>
      <td>string</td>
      <td>Sim</td>
      <td>Data inicial do período no formato yyyy-mm-dd</td>
    </tr>
    <tr>
      <th>final_date</th>
      <td>string</td>
      <td>Sim</td>
      <td>Data final do período no formato yyyy-mm-dd</td>
    </tr>
    <tr>
      <th>order</th>
      <td>integer</td>
      <td>Opcional</td>
      <td>Informe 1 para ordenar pela quantidade de "ups" ou 2 para ordenadar pela quantidade de comentários. Se o parametro não for passado, será considerado 1.</td>
    </tr>
    
  </tbody>
</table>

![image](https://user-images.githubusercontent.com/12559964/160455337-bb089104-9c66-4c84-8eaa-fbb7c889fa40.png)



### authors

![image](https://user-images.githubusercontent.com/12559964/160456311-a097d931-e230-4be8-a410-90ca583c91a7.png)

Retorna uma lista de autores em ordem decrescente seguindo a ordenação estipulada

<table>
  <thead>
    <tr>
      <th>Atributo</th>
      <th>Tipo</th>
      <th>Obrigatoriedade</th>
      <th>Default</th>
      <th>Descrição</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>order</th>
      <td>integer</td>
      <td>Opcional</td>
      <td>1</td>
      <td>Informe 1 para ordenar pela quantidade de "ups" ou 2 para ordenadar pela quantidade de comentários</td>
    </tr>
    
  </tbody>
</table>

![image](https://user-images.githubusercontent.com/12559964/160456435-dd97a757-39ef-452c-a89b-b72de46d81c1.png)



