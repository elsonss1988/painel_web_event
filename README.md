# Live Wizard to WebEvent

![_webevent]("../../assets/img/logo.png)
## Observações

* Checar as configurações setadas em BD com o seu BD (add ao git ignore)
 
* **campos_cadastro** alterado para JSON na tabela de configuracoes


~~~MySQL
alter table configuracoes MODIFY campos_cadastro json
ALTER TABLE webevent.lives MODIFY COLUMN flag_convidados int(1) NULL;
alter table lives change nome nome varchar(150) not null
~~~
~~~PHP
$link->set_charset("utf8");
~~~


## Pendencias

- [X] Adiciona dados de interação
- [X] Adiciona transmissão
- [X] Adiciona cadastro
- [X] Adiciona login
- [x] Adiciona mensagens
- [x] Travamento
- [x] Gravação completa
- [x] Dashboard


## Como usar

```
Em desenvovilmento
```








