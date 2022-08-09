# multi-documents

<!-- Initializer for Laravel Todos START  -->

## TODO

Este projeto foi gerado usando
([Inicializador para Laravel](https://laravel.initializer.dev)). Para finalizar a configuração do projeto, execute o seguinte comando no seu terminal shell:

```shell
./initialize
```

![image](https://user-images.githubusercontent.com/51000704/183752076-e6d076c5-6852-4091-9225-7f0347d3084c.png)

Quando este pacote estiver sendo extraído conforme imagem acima e chegar aos 60%, correr no arquivo shell `./vendor/laravel/sail/bin/sail` e comentar rapidamente as linhas abaixo antes de terminar a descompactação deste pacote para não haver erro de compatibilidade do sistema operacional:

![image](https://user-images.githubusercontent.com/51000704/183752689-bd52216d-f55e-4e47-aa53-b826bf5ddf78.png)

<!-- Initializer for Laravel Todos END  -->
## Desenvolvimento Local

Este projeto utiliza
[Laravel Sail](https://laravel.com/docs/sail) para gerenciar sua pilha de desenvolvimento local. Para instruções de uso mais detalhadas, consulte
a [documentação oficial](https://laravel.com/docs/sail).

### Links

- **multi-documents (local)** http://localhost
- **Visualizar e-mails via Mailhog** http://localhost:8025
- **Painel de administração do MeiliSearch** http://localhost:7700

### Inicie o servidor de desenvolvimento

Não precisa utilizar comandos do [Laravel Sail](https://laravel.com/docs/9.x/sail) para executar este projeto, apenas inicializando o primeiro comando acima em seu terminal bash, de preferência [Git Bash](https://git-scm.com/) ou PowerShell o multi-documents será instalado, construído e executado dentro do [Docker](https://www.docker.com/). Portanto, certifique-se de que o [Docker](https://www.docker.com/) esteja instalado em sua máquina e caso não tenha-o, pode baixá-lo [aqui](https://desktop.docker.com/win/main/amd64/Docker%20Desktop%20Installer.exe). Ah! Antes de clicar neste link anterior, leia a [página](https://docs.docker.com/desktop/) de instalação deste programa para sanar suas dúvidas pré-instalação.

### Crie recursos de front-end

Quem conhece o universo do framework Laravel entenderá como explorar recursos de front-end, utilizando o [Laravel Mix](https://laravel.com/docs/9.x/mix) para fazer o empacotamento dos pacotes [npm](https://www.npmjs.com/), onde há páginas de estilo CSS, bibliotecas e frameworks JavaScript para colocar na pasta pública do projeto.

### Executar testes

Como a execução deste projeto roda dentro do [Docker](https://www.docker.com/), não vejo necessidade de realização de testes já que ele é atualizado em tempo real, mas se você já é um desenvolvedor experiente e enxerga a necessidade de implementar este recurso, é só entrar no diretório do projeto dentro do terminal e digitar:

```shell
./vendor/bin/sail test
```
