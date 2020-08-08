
## Description

Este projeto se baseia em uma api REST feita no framework Laravel, consumida por uma aplicação mobile. O objetivo principal é poder controlar o orçamento e saldo para uma melhor percepção da vida financeira do usuário.


## Routes Extract
    
    - Extract [GET] '/extract/{id}' : retorna um extrato pelo seu id.
    - Extract [GET] '/extract/by_user/{id_user}' : retorna todos os extrato que pertencem ao usuário.  
    - Extract [POST] '/extract' : Cria um extrato com os parâmetros passados. Parametros: user_id, value, description, subtag_id OU investimento_id.
    - Extract [POST] '/extract/edit' : Modifica um extrato com os parâmetros passados. Parametros: user_id, value, description, subtag_id OU investimento_id.
    - Extract [DELETE] '/extract/{id}' : Deleta um extrato pelo id passados.  
