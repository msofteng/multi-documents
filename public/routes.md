
http://localhost/api/usuario/login [POST] atualizar TOKEN cada vez que o usuário logar e devolver o código para ele

<!-- http://localhost/api/usuario/salvar [POST] Cadastrar Usuário {OK} -->
<!-- http://localhost/api/usuario/atualizar [PUT] Atualizar Usuário {OK} -->
<!-- http://localhost/api/usuario/excluir [DELETE] Excluir Usuário {OK} -->

<!-- http://localhost/api/usuario [GET] Listar Usuário {OK} -->
<!-- http://localhost/api/usuarios [GET] Listar Usuários {OK} -->
<!-- http://localhost/api/usuarios/buscar [GET] Buscar Usuários {OK} -->
<!-- http://localhost/api/usuarios/total [GET] Listar Usuários (Total) {OK} -->
<!-- http://localhost/api/usuarios/buscar/total [GET] Buscar Usuários (Total) {OK} -->

<!-- http://localhost/api/documento/salvar [POST] -->
<!-- http://localhost/api/documento/atualizar [PUT] -->
<!-- http://localhost/api/documento/excluir [DELETE] -->

<!-- http://localhost/api/documento [GET] Listar Documento {OK} -->
<!-- http://localhost/api/documentos [GET] Listar Documentos {OK} -->
<!-- http://localhost/api/documentos/buscar [GET] Buscar Documentos {OK} -->
<!-- http://localhost/api/documentos/total [GET] Listar Documentos (Total) {OK} -->
<!-- http://localhost/api/documentos/buscar/total [GET] Buscar Documentos (Total) {OK} -->

<!-- http://localhost/api/parametro/salvar [POST] -->
<!-- http://localhost/api/parametro/atualizar [PUT] -->
<!-- http://localhost/api/parametro/excluir [DELETE] -->

<!-- http://localhost/api/parametro [GET] Listar Parâmetro {OK} -->
<!-- http://localhost/api/parametros [GET] Listar Parâmetros {OK} -->
<!-- http://localhost/api/parametros/buscar [GET] Buscar Parâmetros {OK} -->
<!-- http://localhost/api/parametros/total [GET] Listar Parâmetros (Total) {OK} -->
<!-- http://localhost/api/parametros/buscar/total [GET] Buscar Parâmetros (Total) {OK} -->

<!-- http://localhost/api/documento/dados/adicionar [POST] -->
<!-- http://localhost/api/documento/dados/atualizar [PUT] -->
<!-- http://localhost/api/documento/dados/excluir [DELETE] -->

<!-- http://localhost/api/documento/dado [GET] Listar Informação {OK} -->
<!-- http://localhost/api/documento/dados [GET] Listar Informações {OK} -->
<!-- http://localhost/api/documento/dados/buscar [GET] Buscar Informações {OK} -->
<!-- http://localhost/api/documento/dados/total [GET] Listar Informações (Total) {OK} -->
<!-- http://localhost/api/documento/dados/buscar/total [GET] Buscar Informações (Total) {OK} -->

<!-- http://localhost/api/usuario/documentos/adicionar [POST] -->
<!-- http://localhost/api/usuario/documentos/atualizar [PUT] -->
<!-- http://localhost/api/usuario/documentos/excluir [DELETE] -->

<!-- http://localhost/api/usuario/documento [GET] Listar Dado {OK} -->
<!-- http://localhost/api/usuario/documentos [GET] Listar Dados {OK} -->
<!-- http://localhost/api/usuario/documentos/buscar [GET] Buscar Dados {OK} -->
<!-- http://localhost/api/usuario/documentos/total [GET] Listar Dados (Total) {OK} -->
<!-- http://localhost/api/usuario/documentos/buscar/total [GET] Buscar Dados (Total) {OK} -->



http://localhost/analytics/documento/salvar [POST]
http://localhost/analytics/documento/ [POST]
http://localhost/analytics/documento/dados [POST]
http://localhost/analytics/usuario/salvar [POST]
http://localhost/analytics/usuario/ [POST]
http://localhost/analytics/usuario/simple [POST]
http://localhost/analytics/usuario/documentos [POST]

-- ROTAS PARA VALIDAÇÃO DE REGISTROS (verificar se já existem) DAOUtil

✓ o objetivo é proteger todas as rotas com o TOKEN do usuário, exceto a de login
✓ a cada login o TOKEN do usuário é atualizado, portanto não terá fraudes
✓ cookies e sessões deixo para mais tarde caso este projeto avançe de fase
✓ criar uma camada Util para desenvolver métodos auxiliares no código-fonte


https://www.postman.com/mssilva4/workspace/multi-documents
